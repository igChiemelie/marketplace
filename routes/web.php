<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Storefront\HomeController;
use App\Http\Controllers\Storefront\ProductBrowseController;
use App\Http\Controllers\Storefront\CartController;
use App\Http\Controllers\Checkout\CheckoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Vendor\RegistrationController;
use App\Http\Controllers\Vendor\DashboardController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboard;
use App\Http\Controllers\Customer\ProfileController as CustomerProfileController;
use App\Http\Controllers\Admin\VendorApprovalController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Vendor\VendorProfileController;
use App\Http\Controllers\Vendor\ProductController as VendorProductController;
use App\Http\Controllers\Vendor\OrderController as VendorOrderController;

// use Illuminate\Foundation\Auth\EmailVerificationRequest;
// use Illuminate\Http\Request;


Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/electronics', function () {
    return view('electronics');
});

Route::get('/fashion', function () {
    return view('fashion');
});

Route::get('/beauty', function () {
    return view('beauty');
});

Route::get('/sports', function () {
    return view('sports');
});

Route::get('/vendors', function () {
    return view('vendors');
});

Auth::routes();

// Auth login routes (separate forms)
Route::get('/login', [LoginController::class, 'showCustomerLoginForm'])->name('login.customer');
Route::post('/login', [LoginController::class, 'customerLogin'])->name('login');

Route::get('/login/vendor', [LoginController::class, 'showVendorLoginForm'])->name('login.vendor');
Route::post('/login/vendor', [LoginController::class, 'vendorLogin'])->name('login.vendor.submit');

Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm'])->name('login.admin');
Route::post('/login/admin', [LoginController::class, 'adminLogin'])->name('login.admin.submit');

// Customer Registration
Route::get('/register',[RegisterController::class,'showCustomerRegisterForm'])->name('customer.register.form');
Route::post('/register',[RegisterController::class,'registerCustomer'])->name('customer.register');

// // Email verification routes
// Route::get('/email/verify', function () {
//     return view('auth.verify-email'); // Blade file
// })->middleware('auth')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
//     return redirect()->route('customer.dashboard');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();
//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Customer Area
Route::middleware(['auth','isCustomer'])->group(function(){
    Route::get('/customer/dashboard',[CustomerDashboard::class,'index'])->name('customer.dashboard');
    Route::get('/customer/profile',[CustomerProfileController::class,'edit'])->name('customer.profile');
    Route::put('/customer/profile',[CustomerProfileController::class,'update'])->name('customer.profile.update');
   
    // Checkout
    Route::get('/checkout',[CheckoutController::class,'show'])->name('checkout.show');
    Route::post('/checkout',[CheckoutController::class,'placeOrder'])->name('checkout.place');
    Route::get('/checkout/callback',[CheckoutController::class,'callback'])->name('checkout.callback');
});


// Vendor Registration
Route::get('/vendor/register',[RegistrationController::class,'showRegistrationForm'])->name('vendor.register.form');
Route::post('/vendor/register',[RegistrationController::class,'register'])->name('vendor.register');
Route::get('/vendor/register/success',[RegistrationController::class,'registrationSuccess'])->name('vendor.registration.success');

// Vendor Area
// Route::prefix('vendor')->middleware(['auth','isVendor','isApprovedVendor'])->group(function(){
Route::prefix('vendor')->middleware(['auth','isVendor'])->group(function(){
    Route::get('/dashboard',[DashboardController::class,'index'])->name('vendor.dashboard');
    Route::view('/settings', 'settings');
    Route::view('/transactions', 'transactions');
    Route::view('/review', 'review');

    // Profile
    Route::get('/profile',[VendorProfileController::class,'edit'])->name('vendor.profile.edit');
    Route::put('/profile',[VendorProfileController::class,'update'])->name('vendor.profile.update');

    //Products
    Route::resource('/products', ProductController::class, ['as'=>'vendor']);

    // Orders
    Route::get('/orders',[VendorOrderController::class,'index'])->name('vendor.orders');
    Route::get('/orders/{order}',[VendorOrderController::class,'show'])->name('vendor.orders.show');
    Route::patch('/orders/{order}/status',[VendorOrderController::class,'updateStatus'])->name('vendor.orders.updateStatus');

    //transactions
});


// Product Browsing
Route::get('/products',[ProductBrowseController::class,'index'])->name('products.index');
Route::get('/product/{product:slug}', [ProductBrowseController::class,'show'])->name('products.show');
Route::get('/vendor/{vendor:shop_slug}', [ProductBrowseController::class,'vendorShop'])->name('vendors.shop');

// Cart
Route::get('/cart',[CartController::class,'index'])->name('cart.index');
Route::get('/cart/items',[CartController::class,'getCartItems'])->name('cart.items');
Route::post('/cart/add/{product}',[CartController::class,'add'])->name('cart.add');
Route::patch('/cart/update/{item}',[CartController::class,'update'])->name('cart.update');
Route::delete('/cart/remove/{item}',[CartController::class,'remove'])->name('cart.remove');


// Admin Area
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('/dashboard',[App\Http\Controllers\Admin\AdminDashboardController::class,'index'])->name('admin.dashboard');
    Route::get('/vendors',[VendorApprovalController::class,'index'])->name('admin.vendors.index');
    Route::patch('/vendors/{vendor}/approve',[VendorApprovalController::class,'approve'])->name('admin.vendors.approve');
    Route::patch('/vendors/{vendor}/reject',[VendorApprovalController::class,'reject'])->name('admin.vendors.reject');

    //transactions
    //products
    //customers
    //cms
});



Route::post('/logout', function () {
    Auth::logout();  
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/'); // 👈 redirect to home page
})->name('logout');

// // ----------------------
// // Customer Registration
// // ----------------------
// Route::get('/register', [RegisterController::class,'showCustomerRegisterForm'])->name('customer.register.form');
// Route::post('/register', [RegisterController::class,'registerCustomer'])->name('customer.register');

// // ----------------------
// // Vendor Registration
// // ----------------------
// Route::get('/vendor/register', [RegistrationController::class,'showRegistrationForm'])->name('vendor.register.form');
// Route::post('/vendor/register', [RegistrationController::class,'register'])->name('vendor.register');
// Route::get('/vendor/register/success', [RegistrationController::class,'registrationSuccess'])->name('vendor.registration.success');

// // ----------------------
// // Product Browsing
// // ----------------------
// Route::get('/products', [ProductBrowseController::class,'index'])->name('products.index');
// Route::get('/product/{product:slug}', [ProductBrowseController::class,'show'])->name('products.show');
// Route::get('/vendor/{vendor:shop_slug}', [ProductBrowseController::class,'vendorShop'])->name('vendors.shop');

// // ----------------------
// // Cart
// // ----------------------
// Route::get('/cart', [CartController::class,'index'])->name('cart.index');
// Route::post('/cart/add/{product}', [CartController::class,'add'])->name('cart.add');
// Route::delete('/cart/remove/{item}', [CartController::class,'remove'])->name('cart.remove');

// // ----------------------
// // Customer Area
// // ----------------------
// Route::middleware(['auth','isCustomer'])->group(function () {
//     Route::get('/customer/dashboard', [CustomerDashboard::class,'index'])->name('customer.dashboard');
//     Route::get('/customer/profile', [CustomerProfileController::class,'edit'])->name('customer.profile');
//     Route::put('/customer/profile', [CustomerProfileController::class,'update'])->name('customer.profile.update');

//     // Checkout
//     Route::get('/checkout', [CheckoutController::class,'show'])->name('checkout.show');
//     Route::post('/checkout', [CheckoutController::class,'placeOrder'])->name('checkout.place');
//     Route::get('/checkout/callback', [CheckoutController::class,'callback'])->name('checkout.callback');
// });

// // ----------------------
// // Vendor Area
// // ----------------------
// Route::prefix('vendor')->middleware(['auth','isVendor','isApprovedVendor'])->group(function () {
//     Route::get('/dashboard', [DashboardController::class,'index'])->name('vendor.dashboard');
//     Route::resource('/products', ProductController::class, ['as' => 'vendor']);
// });

// // ----------------------
// // Admin Area
// // ----------------------
// Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function () {
//     Route::get('/dashboard', [AdminDashboardController::class,'index'])->name('admin.dashboard');

//     // Vendor approval
//     Route::get('/vendors', [VendorApprovalController::class,'index'])->name('admin.vendors.index');
//     Route::patch('/vendors/{vendor}/approve', [VendorApprovalController::class,'approve'])->name('admin.vendors.approve');
//     Route::patch('/vendors/{vendor}/reject', [VendorApprovalController::class,'reject'])->name('admin.vendors.reject');
// });
