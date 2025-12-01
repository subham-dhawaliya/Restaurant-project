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

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/contacts', [ContactController::class, 'adminContacts'])->name('contacts');
    Route::resource('hero', \App\Http\Controllers\Admin\HeroSectionController::class);
    Route::resource('about', \App\Http\Controllers\Admin\AboutSectionController::class);
    Route::resource('gallery', \App\Http\Controllers\Admin\GallerySectionController::class);
    Route::resource('menu', \App\Http\Controllers\Admin\MenuSectionController::class);
});
