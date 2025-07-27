<?php
// routes/web.php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminAuthorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

// Home and Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');

// Books Routes
Route::prefix('books')->name('books.')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('index');
    Route::get('/{slug}', [BookController::class, 'show'])->name('show');
    Route::get('/quick-view/{id}', [BookController::class, 'quickView'])->name('quick-view');
});

// Categories Routes
Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/{slug}', [CategoryController::class, 'show'])->name('show');
});

// Authors Routes
Route::prefix('authors')->name('authors.')->group(function () {
    Route::get('/', [AuthorController::class, 'index'])->name('index');
    Route::get('/{slug}', [AuthorController::class, 'show'])->name('show');
});

// Static Pages
Route::view('/privacy-policy', 'pages.privacy-policy')->name('privacy-policy');
Route::view('/terms', 'pages.terms')->name('terms');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/about', 'pages.about')->name('about');
Route::view('/shipping', 'pages.shipping')->name('shipping');
Route::view('/returns', 'pages.returns')->name('returns');
Route::view('/faq', 'pages.faq')->name('faq');

// Authentication Routes
require __DIR__.'/auth.php';

// Redirect dashboard to profile
Route::get('/dashboard', function () {
    return redirect()->route('profile');
})->middleware('auth')->name('dashboard');

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/view', [ProfileController::class, 'show'])->name('profile');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');

    // Cart Routes
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{book}', [CartController::class, 'add'])->name('add');
        Route::patch('/update/{item}', [CartController::class, 'update'])->name('update');
        Route::delete('/remove/{item}', [CartController::class, 'remove'])->name('remove');
        Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
        Route::get('/count', [CartController::class, 'count'])->name('count');
        Route::get('/items', [CartController::class, 'getItems'])->name('items');
    });

    // Checkout Routes
    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('index');
        Route::post('/process', [CheckoutController::class, 'process'])->name('process');
        Route::get('/success/{order}', [CheckoutController::class, 'success'])->name('success');
        Route::get('/cancel', [CheckoutController::class, 'cancel'])->name('cancel');
    });

    // Orders Routes
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{order}', [OrderController::class, 'show'])->name('show');
        Route::post('/{order}/cancel', [OrderController::class, 'cancel'])->name('cancel');
    });
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Admin Books Management
    Route::prefix('books')->name('books.')->group(function () {
        Route::get('/', [AdminBookController::class, 'index'])->name('index');
        Route::get('/create', [AdminBookController::class, 'create'])->name('create');
        Route::post('/', [AdminBookController::class, 'store'])->name('store');
        Route::get('/{book}', [AdminBookController::class, 'show'])->name('show');
        Route::get('/{book}/edit', [AdminBookController::class, 'edit'])->name('edit');
        Route::patch('/{book}', [AdminBookController::class, 'update'])->name('update');
        Route::delete('/{book}', [AdminBookController::class, 'destroy'])->name('destroy');
        Route::patch('/{book}/toggle-status', [AdminBookController::class, 'toggleStatus'])->name('toggle-status');
    });
    
    // Admin Categories Management
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [AdminCategoryController::class, 'index'])->name('index');
        Route::get('/create', [AdminCategoryController::class, 'create'])->name('create');
        Route::post('/', [AdminCategoryController::class, 'store'])->name('store');
        Route::get('/{category}', [AdminCategoryController::class, 'show'])->name('show');
        Route::get('/{category}/edit', [AdminCategoryController::class, 'edit'])->name('edit');
        Route::patch('/{category}', [AdminCategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [AdminCategoryController::class, 'destroy'])->name('destroy');
        Route::patch('/{category}/toggle-status', [AdminCategoryController::class, 'toggleStatus'])->name('toggle-status');
    });
    
    // Admin Authors Management
    Route::prefix('authors')->name('authors.')->group(function () {
        Route::get('/', [AdminAuthorController::class, 'index'])->name('index');
        Route::get('/create', [AdminAuthorController::class, 'create'])->name('create');
        Route::post('/', [AdminAuthorController::class, 'store'])->name('store');
        Route::get('/{author}', [AdminAuthorController::class, 'show'])->name('show');
        Route::get('/{author}/edit', [AdminAuthorController::class, 'edit'])->name('edit');
        Route::patch('/{author}', [AdminAuthorController::class, 'update'])->name('update');
        Route::delete('/{author}', [AdminAuthorController::class, 'destroy'])->name('destroy');
    });
    
    // Admin Orders Management
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [AdminOrderController::class, 'index'])->name('index');
        Route::get('/{order}', [AdminOrderController::class, 'show'])->name('show');
        Route::patch('/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('update-status');
    });
    
    // Admin Users Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::get('/{user}', [AdminUserController::class, 'show'])->name('show');
        Route::patch('/{user}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])->name('toggle-admin');
        Route::delete('/{user}', [AdminUserController::class, 'destroy'])->name('destroy');
    });
});