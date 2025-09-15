<?php
namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;

class CategoryController extends Controller
{

    public function show($slug)
    {
        // Get the category by slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Fetch featured products under this category
        $featured = Product::where('category_id', $category->id)
            ->where('approval_status', 'approved')
            ->where('status', 'active')
            ->latest()
            ->get();

        // Return view with category and featured products
        return view('categories', compact('category', 'featured'));

    }

}
