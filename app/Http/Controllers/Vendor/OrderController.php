<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        // Get vendor's product count
        $vendor = auth()->user()->vendorProfile->products()->count();

        // Get vendorProfile model
        $vendorProfile = auth()->user()->vendorProfile;

        if (!$vendorProfile) {
            abort(403, 'Vendor profile not found.');
        }

        $vendor_id = $vendorProfile->id;

        // Fetch orders that have items belonging to this vendor
        $orders = Order::whereHas('items.product', function ($q) use ($vendor_id) {
            $q->where('vendor_id', $vendor_id);
        })->latest()->paginate(8);

        return view('vendor.orders', compact('vendor', 'orders'));
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

        return back()->with('success', 'Order status updated');
    }


    public function destroy(Order $order)
    {
        // Get the logged-in vendor profile ID
        $vendorId = auth()->user()->vendorProfile->id;

        // Get the order items that belong to this vendor
        $vendorItems = $order->items()->whereHas('product', function ($q) use ($vendorId) {
            $q->where('vendor_id', $vendorId);
        })->get();

        if ($vendorItems->isEmpty()) {
            return redirect()->back()->with('error', 'You do not have permission to delete these order items.');
        }

        // Delete only the vendor's order items
        foreach ($vendorItems as $item) {
            $item->delete();
        }

        // Optionally: if the order now has no items left, delete the order itself
        if ($order->items()->count() === 0) {
            $order->delete();
            return redirect()->route('vendor.dashboard')->with('success', 'All order items deleted. Order removed.');
        }

        return redirect()->route('vendor.dashboard')->with('success', 'Your order items were deleted successfully.');
    }

}
