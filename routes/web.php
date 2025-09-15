<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Storefront\HomeController;
use App\Http\Controllers\Storefront\CategoryController;
use App\Http\Controllers\Storefront\ProductBrowseController;
use App\Http\Controllers\Storefront\CartController;
use App\Http\Controllers\Checkout\CheckoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Vendor\RegistrationController;
use App\Http\Controllers\Vendor\VendorProfileController;
use App\Http\Controllers\Vendor\DashboardController;
use App\Http\Controllers\Vendor\OrderController as VendorOrderController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboard;
use App\Http\Controllers\Customer\ProfileController as CustomerProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\VendorApprovalController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

use Illuminate\Support\Facades\Auth;


// use Illuminate\Foundation\Auth\EmailVerificationRequest;
// use Illuminate\Http\Request;
Auth::routes();


Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/checkout',[HomeController::class,'checkout'])->name('checkout.show');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('categories.show');

// Auth login routes (separate forms)
Route::get('/login', [LoginController::class, 'showCustomerLoginForm'])->name('login.customer');
Route::post('/login', [LoginController::class, 'customerLogin'])->name('login');

Route::get('/login/vendor', [LoginController::class, 'showVendorLoginForm'])->name('login.vendor');
Route::post('/login/vendor', [LoginController::class, 'vendorLogin'])->name('login.vendor.submit');

Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm'])->name('login.admin');
Route::post('/login/admin', [LoginController::class, 'adminLogin'])->name('login.admin.submit');

// Customer Registration
Route::get('/register/customer',[RegisterController::class,'showCustomerRegisterForm'])->name('customer.register.form');
Route::post('/register',[RegisterController::class,'registerCustomer'])->name('customer.register');

//vendor shop
// Route::get('/vendor/{vendor:shop_slug}', [ProductBrowseController::class,'vendorShop'])->name('vendors.shop');

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
    // Route::view('/checkout', 'checkout');

// Customer Area
Route::middleware(['auth','isCustomer'])->group(callback: function(){
    // customer dashboard
    Route::get('/customer/dashboard',[CustomerDashboard::class,'index'])->name('customer.dashboard');
    // orders
    Route::get('/customer/orders',[CustomerDashboard::class,'show'])->name('customer.orders');
    Route::delete('/customer/orders/{id}', [CustomerDashboard::class, 'destroy'])->name('customer.orders.destroy');

    // customer profile
    Route::get('/customer/profile',[CustomerProfileController::class,'edit'])->name('customer.profile');
    Route::put('/customer/profile',[CustomerProfileController::class,'update'])->name('customer.profile.update');
    Route::put('/customer/profile/password',[CustomerProfileController::class,'password'])->name('customer.password.update');
   
    // Checkout
    Route::get('/checkout',[CheckoutController::class,'show'])->name('checkout.show');

    // Route::get('/checkout',[HomeController::class,'checkout'])->name('checkout.show');
    Route::post('/checkout',[CheckoutController::class,'placeOrder'])->name('checkout.place');
    Route::get('/checkout/callback',[CheckoutController::class,'callback'])->name('checkout.callback');
   
    //success
    Route::get('/checkout/success', function () {
        return view('checkout-success');
    })->name('checkout.success');    


    // add reviews
    // wishlist
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
    Route::delete('/orders/{order}',[VendorOrderController::class,'destroy'])->name('vendor.orders.destroy');

    //transactions
});


// Product Browsing
Route::get('/products',[ProductBrowseController::class,'index'])->name('products.index');
Route::get('/product/{product:slug}', [ProductBrowseController::class,'show'])->name('products.show');
Route::get('/vendor/{vendor:shop_slug}', [ProductBrowseController::class,'vendorShop'])->name('vendors.shop');

// Get all vendors
Route::get('/vendors', [VendorProfileController::class, 'index'])->name('vendors.index');

// Cart
Route::get('/cart',[CartController::class,'index'])->name('cart.index');
Route::post('/cart/add/{product}',[CartController::class,'add'])->name('cart.add');
Route::delete('/cart/remove/{item}',[CartController::class,'remove'])->name('cart.remove');


// Admin Area
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('/dashboard',[App\Http\Controllers\Admin\AdminDashboardController::class,'index'])->name('admin.dashboard');

    //vendor approval
    Route::get('/vendors',[VendorApprovalController::class,'index'])->name('admin.vendors.index');
    Route::patch('/vendors/{vendor}/approve',[VendorApprovalController::class,'approve'])->name('admin.vendors.approve');
    Route::patch('/vendors/{vendor}/reject',[VendorApprovalController::class,'reject'])->name('admin.vendors.reject');
    Route::delete('/vendors/{vendor}/destroy',[VendorApprovalController::class,'destroy'])->name('admin.vendors.destroy');


    //transactions
    //products
    Route::resource('/products', AdminProductController::class, ['as' => 'admin']);

    Route::get('/settings', [AdminDashboardController::class, 'profile'])->name('admin.profile');
    Route::put('/settings', [AdminDashboardController::class, 'updatePassword'])->name('admin.updatePassword');
    // Route::view('/orders', 'admin.orders');  
    // Route::view('/orders', 'admin.orders');  
    Route::get('/orders', [AdminDashboardController::class, 'show'])->name('admin.orders.index');
    Route::patch('/orders/{order}/status',[AdminDashboardController::class,'updateStatus'])->name('admin.orders.updateStatus');
    
    // delete orders
    Route::delete('/orders/{order}/destroy',[AdminDashboardController::class,'destroy'])->name('admin.orders.destroy');

    Route::view('/cms', 'admin.cms');
    Route::view('/analytics', 'admin.analytics');


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
