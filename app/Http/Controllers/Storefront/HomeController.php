<?php
namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Product::where('approval_status','approved')
            ->where('status','active')
            ->latest()
            ->take(12)
            ->get();

            $featuredVendors = User::where('role', 'vendor')
            ->where('status', 'active') // optional if you have vendor status
            ->get();

            $categories = Category::where('status', 'active')->get();

            //show vendor stores
            // $vendor = User::where('role', 'vendor');


        return view('home', compact('featured', 'featuredVendors', 'categories'));
    }
}
