<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\PaymentSetting;
use App\Services\AblinerApiException;
use App\Services\AblinerClient;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RuntimeException;

class DonationPaymentController extends Controller
{
    public function store(Request $request, AblinerClient $abliner): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:120'],
            'amount' => ['required', 'integer', 'min:500', 'max:3000000'],
            'phone' => ['required', 'string', 'max:24', 'regex:/^(?:\\+?255[\\s-]?|0)?[67](?:[0-9][\\s-]?){8}$/'],
        ]);

        if (!$abliner->configured()) {
            return response()->json(['message' => 'Mobile money donations are being set up. Please use the bank transfer details for now.'], 503);
        }

        $activeDonation = Donation::where('public_id', $request->session()->get('active_donation_public_id'))
            ->where('status', 'pending')->first();
        if ($activeDonation) {
            return response()->json([
                'public_id' => $activeDonation->public_id,
                'status' => 'pending',
                'message' => 'A mobile money request is already being checked. Please wait for its status before starting another donation.',
            ], 202);
        }

        $digits = preg_replace('/\\D+/', '', $validated['phone']);
        $phone = str_starts_with($digits, '0') ? '255'.substr($digits, 1) : (str_starts_with($digits, '255') ? $digits : '255'.$digits);
        $publicId = (string) Str::ulid();
        $reference = 'CHF-DON-'.$publicId;
        $idempotencyKey = 'chf-donation-'.$publicId;
        $needsReconciliation = false;

        $donation = Donation::create([
            'public_id' => $publicId,
            'donor_name' => $validated['name'],
            'amount' => (int) $validated['amount'],
            'phone' => $phone,
            'status' => 'pending',
            'customer_reference' => $reference,
            'idempotency_key' => $idempotencyKey,
        ]);
        $request->session()->put('active_donation_public_id', $donation->public_id);

        try {
            $deposit = $abliner->createMobileDeposit([
                'amount' => $donation->amount,
                'method' => 'mobile',
                'currency' => 'TZS',
                'phone' => $phone,
                'reference' => $reference,
                'callback_url' => PaymentSetting::current()->callback_url ?: route('webhooks.abliner'),
            ], $idempotencyKey);

            $donation->update([
                'provider_transaction_id' => $deposit['id'] ?? null,
                'provider_reference' => $deposit['reference'] ?? null,
            ]);
        } catch (ConnectionException $exception) {
            report($exception);
            $needsReconciliation = true;
        } catch (AblinerApiException $exception) {
            $donation->update(['provider_error_code' => $exception->providerCode]);
            if ($exception->definitiveRejection) {
                $donation->update(['status' => 'failed']);
                return response()->json(['message' => $exception->getMessage()], 422);
            }

            report($exception);
            $needsReconciliation = true;
        } catch (RuntimeException $exception) {
            report($exception);
            $donation->update(['provider_error_code' => 'request_error']);
            $needsReconciliation = true;
        } catch (\Throwable $exception) {
            // A timeout can happen after the provider accepted the request; keep the
            // idempotency key and pending state so a webhook or safe reconciliation can resolve it.
            report($exception);
            $needsReconciliation = true;
        }

        return response()->json([
            'public_id' => $donation->public_id,
            'status' => $donation->fresh()->status,
            'message' => $needsReconciliation
                ? 'We are checking whether the payment request reached the provider. Please wait for the status here before trying again.'
                : 'Check your phone for the mobile money approval prompt and enter your PIN there. Do not share your PIN with anyone.',
        ], 202);
    }

    public function status(Request $request, string $donation, AblinerClient $abliner): JsonResponse
    {
        $record = Donation::where('public_id', $donation)->firstOrFail();

        if ($record->status === 'pending' && !$record->provider_transaction_id
            && $record->created_at->lte(now()->subSeconds(12))
            && (!$record->provider_checked_at || $record->provider_checked_at->lte(now()->subMinute()))) {
            $record->update(['provider_checked_at' => now()]);
            $transaction = $abliner->findByIdempotencyKey($record->idempotency_key);
            if (is_array($transaction) && $transaction === []) {
                $record->update(['status' => 'failed', 'provider_error_code' => 'not_created']);
            } elseif (is_array($transaction)) {
                $record->update([
                    'provider_transaction_id' => $transaction['id'] ?? null,
                    'provider_reference' => $transaction['reference'] ?? null,
                ]);
            }
            $record->refresh();
        }

        if ($record->status !== 'pending' && $request->session()->get('active_donation_public_id') === $record->public_id) {
            $request->session()->forget('active_donation_public_id');
        }

        return response()->json([
            'status' => $record->status,
            'message' => match ($record->status) {
                'completed' => 'Thank you for supporting Children’s Hope Foundation. Your donation has been received.',
                'failed' => 'The payment was not completed. You can try again or use the bank transfer details.',
                default => 'Waiting for your mobile money approval. Please check your phone.',
            },
        ]);
    }
}
