<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
// use App\Models\VendorProfile;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = auth()->user()->vendorProfile->products()->with('images')->paginate(10);
        $categories = Category::where('status', 'active')->get();
        // $products = Product::all();
        // var_dump($products);
        return view('vendor.products.index', compact('products', 'categories'));

    }

    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        return view('vendor.products.create', compact('categories'));
    }

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

        // $vendor = auth()->user()->vendorProfile;
        $vendor = auth()->user()->vendorProfile;
        if (!$vendor) {
            return redirect()->back()->with('error', 'No vendor profile found');
        }

        $product = Product::create([
            'vendor_id' => $vendor->id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random(4),
            'sku' => $request->sku,
            'price' => $request->price,
            'quantity' => $request->quantity ?? 0,
            'status' => 'active',
            'approval_status' => 'pending',
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

        return redirect()->route('vendor.products.index')->with('success', 'Product created successfully, pending approval.');
    
    }

    // Show product details for editing
    public function edit(Product $product)
    {
        // $this->authorize('update', $product);

        // if (auth()->user()->vendorProfile->id !== $product->vendor_id) {
        //     abort(403, 'Unauthorized action.');
        // }

        $categories = Category::where('status', 'active')->get();

        return view('vendor.products.edit', compact('product', 'categories'));
    }

    // Update product
    public function update(Request $request, Product $product)
    {
        
        //Ensure the product belongs to the logged-in vendor
        $vendorId = auth()->user()->vendorProfile->id; // vendor profile ID
        if ($product->vendor_id !== $vendorId) {
            abort(403, 'You do not own this product.');
        }

        // dd('passed validation', $request->all());   

        try {
            $validated = $request->validate([
                'name' => 'required',
                'sku' => 'required|unique:products,sku,' . $product->id,
                'price' => 'required|numeric',
                'quantity' => 'nullable|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
                'images.*' => 'nullable|image|max:4096',
            ]);
            // dd('passed validation', $validated);
        } catch (ValidationException $e) {
            // dd('validation failed', $e->errors());
        }

        $product->update([
            'name' => $request->name,
            'sku' => $request->sku,
            'price' => $request->price,
            'quantity' => $request->quantity ?? 0,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);

        // Upload new images if any
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $i => $img) {
                $filename = time() . "_{$i}." . $img->getClientOriginalExtension();
                $path = "products/{$product->id}/" . $filename;

                $img->storeAs("products/{$product->id}", $filename, 'public');

                $product->images()->create([
                    'image_path' => $path,
                    'alt_text' => $product->name,
                    'sort_order' => $i,
                    'is_primary' => $i === 0,
                ]);
            }
        }
        return redirect()->route('vendor.products.index')->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function destroy(Product $product)
    {
       //Ensure the product belongs to the logged-in vendor
        $vendorId = auth()->user()->vendorProfile->id; // vendor profile ID
        if ($product->vendor_id !== $vendorId) {
            abort(403, 'You do not own this product.');
        }
        // dd('delete function called', $product->toArray());
       
        // Delete images from storage
        // foreach ($product->images as $img) {
        //     if (Storage::disk('public')->exists($img->image_path)) {
        //         Storage::disk('public')->delete($img->image_path);
        //     }
        // }
        $folderPath = "products/{$product->id}";
        if (Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->deleteDirectory($folderPath);
        }

        $product->delete();

        return redirect()->route('vendor.products.index')->with('success', 'Product deleted successfully!');
    
    }
}