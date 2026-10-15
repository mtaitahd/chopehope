<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\PaymentSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AblinerWebhookController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $settings = PaymentSetting::query()->find(1);
        abort_unless($settings && filled($settings->webhook_secret), 503, 'Webhook is not configured.');

        $timestamp = (string) $request->header('x-webhook-timestamp', '');
        $signature = (string) $request->header('x-webhook-signature', '');
        abort_unless(ctype_digit($timestamp) && abs(now()->timestamp - (int) $timestamp) <= 300, 401, 'Invalid webhook timestamp.');

        $expected = hash_hmac('sha256', $timestamp.'.'.$request->getContent(), $settings->webhook_secret);
        abort_unless(hash_equals($expected, $signature), 401, 'Invalid webhook signature.');

        $eventId = (string) ($request->header('x-webhook-id') ?: $request->input('id', ''));
        $event = (string) $request->input('event', '');
        $data = $request->input('data');
        abort_unless($eventId !== '' && is_array($data), 400, 'Invalid webhook payload.');
        if (!in_array($event, ['transaction.completed', 'transaction.failed'], true)) {
            return response()->json(['received' => true]);
        }

        $reference = $data['customer_reference'] ?? null;
        $donation = Donation::where('customer_reference', $reference)->first();
        abort_unless($donation, 404, 'Donation reference was not found.');
        $expectedStatus = $event === 'transaction.completed' ? 'completed' : 'failed';
        abort_unless(($data['type'] ?? null) === 'deposit'
            && ($data['method'] ?? null) === 'mobile'
            && ($data['currency'] ?? null) === 'TZS'
            && ($data['status'] ?? null) === $expectedStatus, 422, 'Unexpected payment type, status or currency.');
        abort_unless((int) ($data['amount'] ?? 0) === $donation->amount, 422, 'Donation amount did not match.');

        $processed = DB::transaction(function () use ($donation, $data, $event, $eventId): bool {
            $lockedDonation = Donation::whereKey($donation->id)->lockForUpdate()->first();
            if ($lockedDonation->status !== 'pending') {
                return true;
            }

            try {
                DB::table('donation_webhook_receipts')->insert([
                    'event_id' => $eventId,
                    'donation_id' => $lockedDonation->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } catch (\Illuminate\Database\QueryException $exception) {
                if (DB::table('donation_webhook_receipts')->where('event_id', $eventId)->exists()) {
                    return true;
                }

                throw $exception;
            }

            $lockedDonation->update([
                'status' => $event === 'transaction.completed' ? 'completed' : 'failed',
                'provider_transaction_id' => $data['id'] ?? $lockedDonation->provider_transaction_id,
                'provider_reference' => $data['provider_reference'] ?? $lockedDonation->provider_reference,
                'provider_event_id' => $eventId,
                'completed_at' => $event === 'transaction.completed' ? ($data['completed_at'] ?? now()) : null,
            ]);

            return true;
        });

        return response()->json(['received' => $processed]);
    }
}
