<?php
namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $items = CartItem::where('user_id', Auth::id())->with('product.images')->get();
        } else {
            $items = CartItem::where('session_id', session()->getId())->with('product.images')->get();
        }

        $total = $items->reduce(function ($carry, $item) {
            return $carry + ($item->product->price * $item->quantity);
        }, 0);

        return view('storefront.cart.index', compact('items', 'total'));
    }

    public function update(Request $request, CartItem $item)
    {
        if (Auth::check()) {
            abort_unless($item->user_id === Auth::id(), 403);
        } else {
            abort_unless($item->session_id === session()->getId(), 403);
        }

        $qty = max(1, (int)$request->input('quantity', 1));
        $item->update(['quantity' => $qty]);

        return back()->with('success', 'Cart updated successfully');
    }

    public function add(Request $request, Product $product)
    {
        abort_unless($product->isApproved(), 404);
        $qty = max(1, (int)$request->input('quantity', 1));

        if (Auth::check()) {
            $cart = CartItem::where('user_id', Auth::id())->where('product_id', $product->id)->first();
        } else {
            $cart = CartItem::where('session_id', session()->getId())->where('product_id', $product->id)->first();
        }

        if ($cart) {
            $cart->increment('quantity', $qty);
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'session_id' => Auth::check() ? null : session()->getId(),
                'product_id' => $product->id,
                'quantity' => $qty
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!',
            'cartCount' => $this->getCartCount()
        ]);
    }

    public function getCartItems()
    {
        if (Auth::check()) {
            $items = CartItem::where('user_id', Auth::id())->with('product')->get();
        } else {
            $items = CartItem::where('session_id', session()->getId())->with('product')->get();
        }

        return response()->json($items);
    }

    private function getCartCount()
    {
        if (Auth::check()) {
            return CartItem::where('user_id', Auth::id())->sum('quantity');
        } else {
            return CartItem::where('session_id', session()->getId())->sum('quantity');
        }
    }

    public function remove(CartItem $item){

    
        if (Auth::check()) {
            abort_unless($item->user_id === Auth::id(), 403);
        } else {
            abort_unless($item->session_id === session()->getId(), 403);
        }
        $item->delete();
        return back()->with('success','Removed');
    }
}
