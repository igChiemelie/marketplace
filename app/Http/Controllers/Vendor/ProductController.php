<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = auth()->user()->vendorProfile->products()->with('images')->paginate(20);
        $categories = Category::where('status', 'active')->get();

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
        $this->authorize('update', $product);

        if (auth()->user()->vendorProfile->id !== $product->vendor_id) {
        abort(403, 'Unauthorized action.');
    }

        $categories = Category::where('status', 'active')->get();

        return view('vendor.products.edit', compact('product', 'categories'));
    }

    // Update product
    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:products,sku,' . $product->id,
            'price' => 'required|numeric',
            'quantity' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'nullable|image|max:4096',
        ]);

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
        $this->authorize('delete', $product);

        // Delete images from storage
        foreach ($product->images as $img) {
            if (Storage::disk('public')->exists($img->image_path)) {
                Storage::disk('public')->delete($img->image_path);
            }
        }

        $product->delete();

        return redirect()->route('vendor.products.index')->with('success', 'Product deleted successfully!');
    }
}