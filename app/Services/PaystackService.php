<?php
namespace App\Services;

use GuzzleHttp\Client;

class PaystackService
{
    protected $secret;
    protected $client;

    public function __construct()
    {
        $this->secret = config('services.paystack.secret') ?? env('PAYSTACK_SECRET_KEY');
        $this->client = new Client([
            'base_uri' => 'https://api.paystack.co/',
            'headers' => [
                'Authorization' => 'Bearer ' . $this->secret,
                'Accept' => 'application/json',
            ],
            'timeout' => 30,
        ]);
    }

    public function initializeTransaction($email, $amount, $metadata = [])
    {
        $response = $this->client->post('transaction/initialize', [
            'form_params' => [
                'email' => $email,
                'amount' => (int) round($amount * 100),
                'metadata' => json_encode($metadata),
            ]
        ]);
        return json_decode((string)$response->getBody(), true);
    }

    public function verifyTransaction($reference)
    {
        $response = $this->client->get('transaction/verify/' . $reference);
        return json_decode((string)$response->getBody(), true);
    }

    public function createRecipient($name, $account_number, $bank_code)
    {
        // Paystack requires creating a transfer recipient; stub implementation
        $response = $this->client->post('transferrecipient', [
            'form_params' => [
                'type' => 'nuban',
                'name' => $name,
                'account_number' => $account_number,
                'bank_code' => $bank_code,
                'currency' => 'NGN',
            ]
        ]);
        return json_decode((string)$response->getBody(), true);
    }

    public function transferToVendor($recipient_code, $amount, $currency = 'NGN')
    {
        $response = $this->client->post('transfer', [
            'form_params' => [
                'source' => 'balance',
                'reason' => 'Vendor Payout',
                'amount' => (int) round($amount * 100),
                'recipient' => $recipient_code,
                'currency' => $currency,
            ]
        ]);
        return json_decode((string)$response->getBody(), true);
    }
}
