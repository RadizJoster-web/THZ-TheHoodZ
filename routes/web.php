<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Storefront\CatalogController;
use App\Http\Controllers\Storefront\CheckoutController;
use App\Http\Controllers\Storefront\CustomerOrderController;
use App\Http\Controllers\Storefront\ProductDetailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rute Publik Storefront
|--------------------------------------------------------------------------
*/
Route::get('/', [CatalogController::class, 'index'])->name('home');
Route::get('/product/{slug}', [ProductDetailController::class, 'show'])->name('product.show');

/*
|--------------------------------------------------------------------------
| Rute Tamu (Autentikasi Login & Register)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});

/*
|--------------------------------------------------------------------------
| Rute Autentikasi Pengguna
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

    // Transaksi Customer
    Route::middleware('role:customer,admin')->group(function () {
        Route::post('/checkout/{product}', [CheckoutController::class, 'checkout'])->name('checkout.store');
        Route::get('/my-orders', [CustomerOrderController::class, 'index'])->name('my-orders.index');
        Route::put('/my-orders/{order}/upload-proof', [CustomerOrderController::class, 'uploadProof'])->name('my-orders.upload');
    });

    // Backoffice Admin
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('orders', OrderController::class);
        Route::resource('users', UserController::class);
    });
});
