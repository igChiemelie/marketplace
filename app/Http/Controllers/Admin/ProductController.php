<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $products = Product::with(['vendor', 'images'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
       
        $categories = Category::where('status', 'active')->get();

        return view('admin.products.product', compact('products','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:products,sku',
            'price' => 'required|numeric',
            'quantity' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'nullable|image|max:4096',
        ]);

        
        
        $vendor = auth()->user()->vendorProfile;
        $product = Product::create([
            'vendor_id' => $vendor ? $vendor->id : null, // only set if vendor exists
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random(4),
            'sku' => $request->sku,
            'price' => $request->price,
            'quantity' => $request->quantity ?? 0,
            'status' => 'active',
            'approval_status' => $vendor ? 'pending' : 'approved', // vendors need approval, admin doesn’t
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);



        // Save images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $i => $img) {
                $filename = time() . "_{$i}." . $img->getClientOriginalExtension();
                $path = "products/{$product->id}/" . $filename;

                $img->storeAs("products/{$product->id}", $filename, 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'alt_text' => $request->name,
                    'sort_order' => $i,
                    'is_primary' => $i === 0,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // dd($product);
        // Define folder path
        $folderPath = "products/{$product->id}";

        // Delete folder and all its contents if it exists
        if (Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->deleteDirectory($folderPath);
        }

        // Delete the product record
        $product->delete();

        return redirect()->route('admin.products.index')
                        ->with('success', 'Product deleted successfully.');
    
    }
}
