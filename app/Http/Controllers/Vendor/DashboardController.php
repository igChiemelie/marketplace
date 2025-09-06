<?php
namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\VendorProfile;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $vendor = auth()->user()->vendorProfile->products()->count();
        // $vendor = auth()->user()->vendorProfile;
        $order = Order::whereHas('items.product', function($q){
            $q->where('vendor_id', auth()->id());
        })->latest()->count();

        return view('vendor.index', compact('vendor', 'order'));
    }
}
