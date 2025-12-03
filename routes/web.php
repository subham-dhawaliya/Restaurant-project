<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    $heroSection = \App\Models\HeroSection::where('is_active', true)->latest()->first();
    return view('home', compact('heroSection'));
});
Route::get('/home', function () {
    $heroSection = \App\Models\HeroSection::where('is_active', true)->latest()->first();
    return view('home', compact('heroSection'));
});
Route::get('/about', function () {
    $aboutSection = \App\Models\AboutSection::where('is_active', true)->latest()->first();
    return view('about', compact('aboutSection'));
});
Route::get('/gallery', function () {
    return view('gallery');
});
Route::get('/menu', function () {
    $menuItems = \App\Models\MenuSection::where('is_active', true)->orderBy('category')->orderBy('order')->get();
    return view('menu', compact('menuItems'));
});
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// User Authentication Routes
Route::get('/user/register', [\App\Http\Controllers\UserAuthController::class, 'showRegister'])->name('user.register');
Route::post('/user/register', [\App\Http\Controllers\UserAuthController::class, 'register'])->name('user.register.submit');
Route::get('/user/login', [\App\Http\Controllers\UserAuthController::class, 'showLogin'])->name('user.login');
Route::post('/user/login', [\App\Http\Controllers\UserAuthController::class, 'login'])->name('user.login.submit');
Route::post('/user/logout', [\App\Http\Controllers\UserAuthController::class, 'logout'])->name('user.logout');

// Cart & Checkout Routes
Route::get('/cart', function () {
    // If admin is logged in, logout and redirect to home
    if (Auth::check() && (Auth::user()->role === 'admin' || (isset(Auth::user()->is_admin) && Auth::user()->is_admin))) {
        Auth::logout();
        return redirect()->route('home')->with('error', 'Admin cannot access cart. Please login with a customer account.');
    }
    return view('cart');
})->name('cart');
Route::get('/checkout', function () {
    // If not logged in, redirect to user login
    if (!Auth::check()) {
        return redirect()->route('user.login')->with('error', 'Please login to continue');
    }
    
    // If admin is logged in, prevent access to checkout
    if (Auth::user()->role === 'admin' || (isset(Auth::user()->is_admin) && Auth::user()->is_admin)) {
        Auth::logout();
        return redirect()->route('user.login')->with('error', 'Please login with a customer account to place orders');
    }
    
    return view('checkout');
})->name('checkout');

// Order Routes (Customer Only)
Route::middleware(['auth'])->group(function () {
    Route::post('/order/place', function(\Illuminate\Http\Request $request) {
        // Prevent admin from placing orders
        if (Auth::user()->role === 'admin' || (isset(Auth::user()->is_admin) && Auth::user()->is_admin)) {
            return response()->json(['success' => false, 'message' => 'Admin cannot place orders'], 403);
        }
        return app(\App\Http\Controllers\OrderController::class)->placeOrder($request);
    })->name('order.place');
    
    Route::get('/my-orders', function() {
        // Prevent admin from accessing customer orders page
        if (Auth::user()->role === 'admin' || (isset(Auth::user()->is_admin) && Auth::user()->is_admin)) {
            return redirect()->route('admin.orders.index');
        }
        return app(\App\Http\Controllers\OrderController::class)->myOrders();
    })->name('user.orders');
    
    Route::get('/order/{id}', function($id) {
        // Prevent admin from accessing customer order details
        if (Auth::user()->role === 'admin' || (isset(Auth::user()->is_admin) && Auth::user()->is_admin)) {
            return redirect()->route('admin.orders.show', $id);
        }
        return app(\App\Http\Controllers\OrderController::class)->orderDetails($id);
    })->name('user.order.details');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');

// Admin Routes (Admin Only)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/contacts', [ContactController::class, 'adminContacts'])->name('contacts');
    Route::post('/contacts/reply', [ContactController::class, 'sendReply'])->name('contacts.reply');
    
    // Orders Management
    Route::get('/orders', [\App\Http\Controllers\Admin\OrderManagementController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [\App\Http\Controllers\Admin\OrderManagementController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/status', [\App\Http\Controllers\Admin\OrderManagementController::class, 'updateStatus'])->name('orders.updateStatus');
    
    // Users Management
    Route::get('/users', [\App\Http\Controllers\Admin\UserManagementController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [\App\Http\Controllers\Admin\UserManagementController::class, 'show'])->name('users.show');
    
    Route::resource('hero', \App\Http\Controllers\Admin\HeroSectionController::class);
    Route::resource('about', \App\Http\Controllers\Admin\AboutSectionController::class);
    Route::resource('gallery', \App\Http\Controllers\Admin\GallerySectionController::class);
    Route::resource('menu', \App\Http\Controllers\Admin\MenuSectionController::class);
});
