<?php

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class PaystackWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Verify Paystack signature
        $signature = $request->header('x-paystack-signature');
        $secret    = config('services.paystack.secret') ?? env('PAYSTACK_SECRET_KEY');

        if (!$signature || ($signature !== hash_hmac('sha512', $request->getContent(), $secret))) {
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        // Decode JSON payload
        $event = $request->all();

        if (!isset($event['event'])) {
            return response()->json(['error' => 'Invalid payload'], 400);
        }

        switch ($event['event']) {
            case 'charge.success':
                $reference = $event['data']['reference'] ?? null;
                $metadata  = $event['data']['metadata'] ?? [];

                if ($reference && isset($metadata['order_id'])) {
                    $order = Order::find($metadata['order_id']);

                    if ($order && $order->payment_status !== 'paid') {
                        $order->update([
                            'payment_status' => 'paid',
                            'status' => 'processing',
                        ]);
                    }
                }
                break;

            case 'charge.failed':
                // Optionally handle failed payments
                break;

            default:
                // Other Paystack events (optional)
                break;
        }

        // Always return 200 so Paystack knows we received it
        return response()->json(['status' => 'success'], 200);
    }
}
