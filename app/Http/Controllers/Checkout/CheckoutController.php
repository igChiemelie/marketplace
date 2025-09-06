<?php
namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
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
        $items = CartItem::where('user_id', auth()->id())->with('product.vendor')->get();
        abort_if($items->isEmpty(), 404, 'Cart empty');
        $summary = $this->calculate($items);
        return view('storefront.checkout.show', compact('items','summary'));
    }

    public function placeOrder(Request $request)
    {
        $items = CartItem::where('user_id', auth()->id())->with('product.vendor')->get();
        abort_if($items->isEmpty(), 422, 'Cart empty');
        $summary = $this->calculate($items);
        DB::transaction(function() use ($items, $summary, &$order, $request) {
            $order = Order::create([
                'order_number' => strtoupper(Str::random(12)),
                'customer_id' => auth()->id(),
                'total_amount' => $summary['grand_total'],
                'tax_amount' => $summary['tax_total'],
                'shipping_amount' => $summary['shipping_total'],
                'discount_amount' => 0,
                'status' => 'pending',
                'payment_status' => 'pending',
            ]);

            foreach ($items as $ci) {
                $product = $ci->product;
                if ($product->track_quantity && !$product->allow_backorder && $product->quantity < $ci->quantity) {
                    abort(422, "Insufficient stock for {$product->name}");
                }
                if ($product->track_quantity) $product->decrement('quantity', $ci->quantity);
                $lineTotal = $product->price * $ci->quantity;
                $orderItem = OrderItem::create(['order_id'=>$order->id,'product_id'=>$product->id,'vendor_id'=>$product->vendor_id,'quantity'=>$ci->quantity,'price'=>$product->price,'total'=>$lineTotal]);
                // create vendor commission record etc (omitted for brevity)
                // notify vendor
                $vendorUser = $product->vendor->user;
                Mail::to($vendorUser->email)->queue(new VendorOrderNotificationMail($product->vendor, [$orderItem]));
            }

            CartItem::where('user_id', auth()->id())->update(['checked_out'=>true]);
        });

        // initialize Paystack transaction
        $init = $this->paystack->initializeTransaction(auth()->user()->email, $summary['grand_total'], ['order_id'=>$order->id]);
        if (!empty($init['data']['authorization_url'])) {
            // store transaction reference in DB (omitted) and redirect user
            return redirect($init['data']['authorization_url']);
        }

        return redirect()->route('customer.dashboard')->with('error','Payment initiation failed');
    }

    public function callback(Request $request)
    {
        $ref = $request->query('reference');
        $verify = $this->paystack->verifyTransaction($ref);
        if (!empty($verify['data']['status']) && $verify['data']['status'] === 'success') {
            // find order by metadata (omitted) and mark paid
            return redirect()->route('customer.dashboard')->with('success','Payment successful');
        }
        return redirect()->route('customer.dashboard')->with('error','Payment failed');
    }

    protected function calculate($items)
    {
        $subtotal = $items->sum(fn($i) => $i->product->price * $i->quantity);
        $tax = 0;
        $shipping = 0;
        return ['subtotal'=>$subtotal,'tax_total'=>$tax,'shipping_total'=>$shipping,'grand_total'=>$subtotal+$tax+$shipping];
    }
}
