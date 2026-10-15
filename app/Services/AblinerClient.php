<?php

namespace App\Services;

use App\Models\PaymentSetting;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class AblinerClient
{
    public function configured(): bool
    {
        return PaymentSetting::current()->isConfigured();
    }

    public function createMobileDeposit(array $payload, string $idempotencyKey): array
    {
        $settings = PaymentSetting::current();
        if (!$settings->isConfigured()) {
            throw new RuntimeException('Mobile money donations are not configured yet.');
        }

        $rawBody = json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        $timestamp = (string) now()->timestamp;
        $signature = hash_hmac('sha256', $timestamp.'.'.$rawBody, $settings->webhook_secret);
        $baseUrl = rtrim($settings->api_base_url, '/');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$settings->api_key,
            'Content-Type' => 'application/json',
            'Idempotency-Key' => $idempotencyKey,
            'x-abliner-timestamp' => $timestamp,
            'x-abliner-signature' => $signature,
        ])->timeout(20)->withBody($rawBody, 'application/json')->post($baseUrl.'/api/v1/deposits');

        $body = $response->json();
        if (!$response->successful() || !is_array($body) || !is_array($body['data'] ?? null)) {
            $code = is_array($body) ? ($body['code'] ?? 'provider_error') : 'provider_error';
            $definitive = in_array($response->status(), [400, 401, 402, 403, 422], true);
            throw new AblinerApiException('Abliner could not start the payment ('.$code.'). Please check the payment settings or use bank transfer.', $code, $definitive);
        }

        return $body['data'];
    }

    public function balance(): ?array
    {
        $settings = PaymentSetting::current();
        if (!$settings->hasApiKey()) {
            return null;
        }

        try {
            $response = Http::withToken($settings->api_key)->acceptJson()->timeout(5)
                ->get(rtrim($settings->api_base_url, '/').'/api/v1/balance');

            if (!$response->successful() || !is_array($response->json('data'))) {
                return null;
            }

            return $response->json('data');
        } catch (\Throwable) {
            return null;
        }
    }

    public function findByIdempotencyKey(string $idempotencyKey): ?array
    {
        $settings = PaymentSetting::current();
        if (!$settings->hasApiKey()) {
            return null;
        }

        try {
            $response = Http::withToken($settings->api_key)->acceptJson()->timeout(5)
                ->get(rtrim($settings->api_base_url, '/').'/api/v1/transactions', ['idempotency_key' => $idempotencyKey]);
            if (!$response->successful()) {
                return null;
            }

            $data = $response->json('data');
            return is_array($data) ? (array_is_list($data) ? ($data[0] ?? []) : $data) : null;
        } catch (\Throwable) {
            return null;
        }
    }
}
