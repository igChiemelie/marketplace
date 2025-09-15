<?php
namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\VendorProfile;

class ProductBrowseController extends Controller
{
    public function index()
    {
        $products = Product::where('approval_status','approved')->where('status','active')->paginate(24);
        return view('products', compact('products'));
    }

    public function show(Product $product)
    {
        abort_unless($product->isApproved(),404);
        return view('storefront.products.show', compact('product'));
    }

    public function vendorShop(VendorProfile $vendor)
    {
        // dd(123);
        abort_unless($vendor->isApproved(),404);
        $products = $vendor->products()->where('approval_status','approved')->where('status','active')->paginate(24);
        return view('vendor', compact('vendor','products'));
    }
}
