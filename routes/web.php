<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

// ============================================
// ADMIN ROUTES
// ============================================

Route::prefix('admin')->name('admin.')->group(function () {

    // Guest routes (login qilmaganlar)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])
            ->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])
            ->name('login.post');
    });

    // Protected routes (faqat adminlar)
    Route::middleware(['auth', 'admin.web'])->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Categories
        Route::resource('categories', CategoryController::class);

        // Brands (keyinroq qo'shiladi)
        // Route::resource('brands', BrandController::class);

        // Products (keyinroq qo'shiladi)
        // Route::resource('products', ProductController::class);

        // Orders (keyinroq qo'shiladi)
        // Route::resource('orders', OrderController::class);

        // Users (keyinroq qo'shiladi)
        // Route::resource('users', UserController::class);

        // Logout
        Route::post('/logout', [AdminAuthController::class, 'logout'])
            ->name('logout');
    });
});

// ============================================
// PUBLIC ROUTES
// ============================================

Route::get('/', function () {
    return view('welcome');
});
