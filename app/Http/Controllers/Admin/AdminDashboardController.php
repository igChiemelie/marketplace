<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class AdminDashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $orders = Order::latest()->paginate(10);
        // $categories = Category::where('status', 'active')->get();

        $users = User::where('role', '!=', 'admin')->get();

        return view('admin.index', compact('products', 'orders', 'users'));
    }

    public function show()
    {
        $orders = Order::latest()->paginate(15);
        return view('admin.orders', compact('orders'));
    }



    public function destroy(Order $order)
    {
        try {
            // Delete related order items first
            $order->items()->delete();

            // Then delete the order itself
            $order->delete();

            return redirect()->back()->with('success', 'Order item deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete order: ' . $e->getMessage());
        }
    }

    public function updateStatus(Order $order)
    {
        request()->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order->update(['status' => request('status')]);

        return back()->with('success', 'Order status updated');
    }

    public function profile()
    {
        return view('admin.settings');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|string|max:20',
            'bank_name' => 'nullable|string|max:100',
            'acct_name' => 'nullable|string|max:100',
            'acct_no' => 'nullable|numeric',

            // Password validation
            'current_password' => 'required_with:password',
            'password' => 'nullable|min:8|confirmed',
        ], [
            'password.confirmed' => 'Password confirmation does not match.',
            'current_password.required_with' => 'You must enter your current password to set a new one.',
        ]);

        $admin = auth()->user();

        // Update profile fields
        $admin->phone = $request->phone;
        $admin->bank_name = $request->bank_name;
        $admin->acct_name = $request->acct_name;
        $admin->acct_no = $request->acct_no;

        // Update password only if provided
        if ($request->filled('password')) {
            // Verify current password
            if (!Hash::check($request->current_password, $admin->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }

            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->back()->with('success', 'Admin settings updated successfully.');
    }
}
