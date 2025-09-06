<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Wishlist;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::where('customer_id', auth()->id())->latest()->get();
        $wishlist = Wishlist::where('user_id', auth()->id())->with('product')->get();
        $transactions = Transaction::where('user_id', auth()->id())->latest()->get();
        return view('customer.dashboard', compact('orders','wishlist','transactions'));
    }
}
