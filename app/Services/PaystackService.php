<?php
namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class PaystackService
{
    protected $secret;
    protected $client;

    public function __construct()
    {
        $this->secret = config('services.paystack.secret') ?? env('PAYSTACK_SECRET_KEY');
        $this->client = new Client([
            'base_uri' => config('services.paystack.url', 'https://api.paystack.co'),
            'timeout'  => 30,
            'headers'  => [
                'Authorization' => 'Bearer ' . $this->secret,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function initializeTransaction(string $email, float $amount, array $metadata = [], ?string $callbackUrl = null): array
    {
        $payload = [
            'email' => $email,
            'amount' => (int) round($amount * 100), // paystack expects kobo
            'metadata' => $metadata,
        ];

        $payload['callback_url'] = $callbackUrl ?? route('checkout.callback');

        try {
            $resp = $this->client->post('transaction/initialize', ['json' => $payload]);
            return json_decode((string)$resp->getBody(), true);
        } catch (RequestException $e) {
            Log::error('Paystack initializeTransaction error', [
                'message' => $e->getMessage(),
                'response' => $e->hasResponse() ? (string)$e->getResponse()->getBody() : null,
            ]);
            return ['status' => false, 'message' => 'Paystack initialize failed', 'error' => $e->getMessage()];
        }
    }

    public function verifyTransaction(string $reference): array
    {
        try {
            $resp = $this->client->get("transaction/verify/{$reference}");
            return json_decode((string)$resp->getBody(), true);
        } catch (RequestException $e) {
            Log::error('Paystack verifyTransaction error', [
                'message' => $e->getMessage(),
                'response' => $e->hasResponse() ? (string)$e->getResponse()->getBody() : null,
            ]);
            return ['status' => false, 'message' => 'Paystack verify failed', 'error' => $e->getMessage()];
        }
    }

    public function createRecipient(string $name, string $account_number, string $bank_code): array
    {
        try {
            $resp = $this->client->post('transferrecipient', [
                'json' => [
                    'type' => 'nuban',
                    'name' => $name,
                    'account_number' => $account_number,
                    'bank_code' => $bank_code,
                    'currency' => 'NGN',
                ]
            ]);
            return json_decode((string)$resp->getBody(), true);
        } catch (RequestException $e) {
            Log::error('Paystack createRecipient error', ['message' => $e->getMessage()]);
            return ['status' => false, 'message' => 'createRecipient failed', 'error' => $e->getMessage()];
        }
    }

    public function transferToVendor(string $recipient_code, float $amount, string $currency = 'NGN'): array
    {
        try {
            $resp = $this->client->post('transfer', [
                'json' => [
                    'source' => 'balance',
                    'reason' => 'Vendor Payout',
                    'amount' => (int) round($amount * 100),
                    'recipient' => $recipient_code,
                    'currency' => $currency,
                ]
            ]);
            return json_decode((string)$resp->getBody(), true);
        } catch (RequestException $e) {
            Log::error('Paystack transferToVendor error', ['message' => $e->getMessage()]);
            return ['status' => false, 'message' => 'transfer failed', 'error' => $e->getMessage()];
        }
    }
}
