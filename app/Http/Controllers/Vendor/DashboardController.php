<?php
namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\VendorProfile;
use App\Models\Order;

class DashboardController extends Controller
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
        })->latest()->get();

        return view('vendor.index', compact('vendor', 'orders'));
    }
}
