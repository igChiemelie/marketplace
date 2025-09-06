<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartComposer
{
    public function compose(View $view)
    {
        $view->with('cartCount', $this->getCartCount());
    }

    private function getCartCount()
    {
        if (Auth::check()) {
            return CartItem::where('user_id', Auth::id())->sum('quantity');
        } else {
            return CartItem::where('session_id', session()->getId())->sum('quantity');
        }
    }
}
