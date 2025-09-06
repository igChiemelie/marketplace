<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\VendorProfile;
use App\Notifications\VendorApproved;

class VendorApprovalController extends Controller
{
    public function index()
    {
        $vendors = VendorProfile::with('user')->paginate(20);
        return view('admin.vendors.index', compact('vendors'));
    }
    public function approve(VendorProfile $vendor)
    {
        $vendor->update(['approval_status' => 'approved']);
        $vendor->user->update(['status' => 'active']);
        $vendor->user->notify(new VendorApproved($vendor));
        return back()->with('success', 'Vendor approved');
    }
    public function reject(VendorProfile $vendor)
    {
        $vendor->update(['approval_status' => 'rejected']);
        $vendor->user->update(['status' => 'inactive']);
        return back()->with('success', 'Vendor rejected');
    }
}
