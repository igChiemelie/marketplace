<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::whereHas('items.product', function($q){
            $q->where('vendor_id', Auth::id());
        })->latest()->get();

        return view('vendor.orders', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('vendor.orders.show', compact('order'));
    }

    public function updateStatus(Order $order)
    {
        request()->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order->update(['status' => request('status')]);

        return back()->with('success','Order status updated');
    }
}
