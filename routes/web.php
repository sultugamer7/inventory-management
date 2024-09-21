<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierOrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false,
]);

Route::get('/system', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// CATEGORIES
Route::resource('categories', CategoryController::class)->except(['show']);
Route::post('categories/search', [CategoryController::class, 'search'])->name('categories.search');

// CUSTOMERS
Route::resource('customers', CustomerController::class);
Route::post('customers/search', [CustomerController::class, 'search'])->name('customers.search');

// SUPPLIERS
Route::resource('suppliers', SupplierController::class);
Route::post('suppliers/search', [SupplierController::class, 'search'])->name('suppliers.search');

// PRODUCTS
Route::prefix('suppliers/{supplier}')->name('suppliers.')->group(function () {
    Route::resource('/products', ProductController::class)->except(['show']);
    Route::post('/products/search', [ProductController::class, 'search'])->name('products.search');
});

// SUPPLIER ORDERS
Route::resource('supplier-orders', SupplierOrderController::class)->only(['index', 'create', 'show']);
