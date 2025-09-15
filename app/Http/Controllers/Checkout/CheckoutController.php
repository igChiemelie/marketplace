<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorProfile;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Mail\VendorOrderNotificationMail;
use Illuminate\Support\Facades\Mail;
use App\Services\PaystackService;

class CheckoutController extends Controller
{
    protected $paystack;

    public function __construct(PaystackService $paystack)
    {
        $this->paystack = $paystack;
        $this->middleware('auth');
    }

    public function show()
    {
        return view('checkout')->with('account_details', [
            'bank'   => 'First Bank',
            'name'   => 'QFS SecureHub Ltd',
            'number' => '1234567890',
        ]);
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email'    => 'required|email',
            'phone'    => 'required|string|max:20',
            'address'  => 'required|string',
            'city'     => 'required|string|max:100',
            'zip'      => 'required|string|max:20',
            'payment'  => 'required|string|in:card,paypal,money_transfer,cod',
            'cart'     => 'required',
        ]);

        $cart = json_decode($request->cart, true);
        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }

        // Calculate total
        $total = collect($cart)->reduce(function ($carry, $item) {
            return $carry + ($item['product']['price'] * $item['quantity']);
        }, 0);

        // Create order & order items
        DB::transaction(function () use ($request, $cart, $total, &$order) {
            $order = Order::create([
                'order_number'   => strtoupper(Str::random(12)),
                'customer_id'    => auth()->id(),
                'fullname'       => $request->fullname,
                'email'          => $request->email,
                'phone'          => $request->phone,
                'address'        => $request->address,
                'city'           => $request->city,
                'zip'            => $request->zip,
                'payment_method' => $request->payment,
                'total_amount'   => $total,
                'status'         => 'pending',
                'payment_status' => in_array($request->payment, ['card']) ? 'pending' : 'pending',
            ]);

            foreach ($cart as $item) {
                $vendorId = $item['product']['vendor'] ?? null;

                $orderItem = OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['product']['id'],
                    'vendor_id'  => $item['product']['vendor'] ?? 1,
                    'quantity'   => $item['quantity'],
                    'price'      => $item['product']['price'],
                    'total'      => $item['product']['price'] * $item['quantity'],
                ]);

                $vendor = VendorProfile::find($vendorId);
                $vendorUser = $vendor?->user;

                if ($vendorUser && $vendorUser->email) {
                    Mail::to($vendorUser->email)->queue(
                        new VendorOrderNotificationMail($vendor, $order, $orderItem)
                    );
                }
            }
        });

        // Handle payment
        switch ($request->payment) {
            case 'money_transfer':
            case 'cod':
                return redirect()->route('checkout.success')
                    ->with('success', 'Order placed successfully! Please use the details below to complete payment.')
                    ->with('account_details', [
                        'bank'   => 'First Bank',
                        'name'   => 'QFS SecureHub Ltd',
                        'number' => '1234567890',
                        'amount' => $total,
                    ]);

            case 'card':
                $init = $this->paystack->initializeTransaction(
                    $request->email,
                    $total,
                    ['order_id' => $order->id]
                );

                if (!empty($init['data']['authorization_url']) && !empty($init['data']['reference'])) {
                    // Save Paystack reference to order for later verification
                    $order->update([
                        'transaction_reference' => $init['data']['reference'],
                    ]);

                    return redirect($init['data']['authorization_url']);
                }

                return redirect()->route('customer.dashboard')->with('error', 'Payment initiation failed.');

            case 'paypal':
                return redirect()->route('customer.dashboard')->with('info', 'PayPal integration coming soon.');
        }
    }

    public function callback(Request $request)
    {
        $ref = $request->query('reference');
        $verify = $this->paystack->verifyTransaction($ref);

        if (!empty($verify['data']['status']) && $verify['data']['status'] === 'success') {
            // Find order by reference
            $order = Order::where('transaction_reference', $ref)->first();
            if ($order && $order->payment_status !== 'paid') {
                $order->update([
                    'payment_status' => 'paid',
                    'status' => 'processing',
                ]);
            }

            return redirect()->route('customer.dashboard')->with('success', 'Payment successful');
        }

        return redirect()->route('customer.dashboard')->with('error', 'Payment failed');
    }
}
