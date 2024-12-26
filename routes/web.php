<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestimonyController;
use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/register', [AuthController::class, 'userRegister'])->name('user_register');
Route::post('/login', [AuthController::class, 'userLogin'])->name('user_login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/top-up', [AuthController::class, 'topUp'])->name('top_up');

// Product and Order Routes
Route::get('/productPage', [AuthController::class, 'productPage'])->name('product_page');
Route::get('/buy/{product}', [OrderController::class, 'buy'])->name('buy_product');
Route::get('/order/{product}', [OrderController::class, 'order'])->name('order_product');
Route::get('/checkout/{total}', [OrderController::class, 'checkout'])->name('checkout_product');
Route::delete('/delete/{id}', [OrderController::class, 'delete_from_cart'])->name('delete_from_cart');
Route::post('/review/{id}', [OrderController::class, 'addReview'])->name('add_review');

// Admin Routes with Middleware
Route::prefix('admin')->group(function () {
    // Product Management
    Route::get('/', [ProductController::class, 'index'])->name('admin_table');
    Route::post('/logout', [AuthController::class, 'logoutAdmin'])->name('logout_admin');
    Route::get('/create', [ProductController::class, 'create'])->name('add_product');
    Route::post('/store', [ProductController::class, 'store'])->name('store_product');
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit_product');
    Route::post('/update/{product}', [ProductController::class, 'update'])->name('update_product');
    Route::delete('/delete/{product}', [ProductController::class, 'delete'])->name('delete_product');
    Route::get('/search', [ProductController::class, 'search'])->name('search_product');
    Route::get('/category/{category}', [OrderController::class, 'category'])->name('category_product');

    // Testimony Management
    Route::get('/testimony', [TestimonyController::class, 'index'])->name('testimony_homepage');
    Route::get('/testimony/create', [TestimonyController::class, 'create'])->name('add_testimony');
    Route::post('/testimony/store', [TestimonyController::class, 'store'])->name('store_testimony');
    Route::get('/testimony/edit/{testimony}', [TestimonyController::class, 'edit'])->name('edit_testimony');
    Route::post('/testimony/update/{testimony}', [TestimonyController::class, 'update'])->name('update_testimony');
    Route::delete('/testimony/delete/{testimony}', [TestimonyController::class, 'delete'])->name('delete_testimony');
    Route::get('/testimony/search', [TestimonyController::class, 'search'])->name('search_testimony');

    // Sales Management
    Route::get('/sales', [SalesController::class, 'index'])->name('sales_homepage');
    Route::post('/sales/update/{invoiceHeader}', [SalesController::class, 'update_status'])->name('update_status');
});
