<?php
namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\VendorProfile;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Product::where('approval_status','approved')
            ->where('status','active')
            ->latest()
            ->paginate(5);
            
        $featuredVendors = VendorProfile::where('approval_status', 'approved') // assuming VendorProfile has this column
        ->latest()
        ->withCount('products') // so you can show product count in Blade
        ->get();

        $categories = Category::where('status', 'active')->get();
        return view('home', compact('featured', 'featuredVendors','categories'));
    }
}
