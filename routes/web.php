<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\SupplierOrderController;

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
Route::get('supplier-orders/{supplierOrder}/pdf', [SupplierOrderController::class, 'pdf'])->name('supplier-orders.pdf');

// CUSTOMER ORDERS
Route::resource('customer-orders', CustomerOrderController::class)->only(['index', 'create', 'show']);
Route::get('customer-orders/{customerOrder}/pdf', [CustomerOrderController::class, 'pdf'])->name('customer-orders.pdf');

// REPORTS
Route::get('reports/supplier-orders', [ReportController::class, 'supplierOrders'])->name('reports.supplier-orders');
Route::get('reports/customer-orders', [ReportController::class, 'customerOrders'])->name('reports.customer-orders');
