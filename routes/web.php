<?php

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
