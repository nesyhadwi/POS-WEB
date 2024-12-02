<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\ProductController; 
use App\Http\Controllers\TransaksiController; 

Route::get('', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Dashboard berdasarkan role
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/kasir/dashboard', [KasirController::class, 'dashboard'])->name('kasir.dashboard');
    Route::get('/owner/dashboard', [OwnerController::class, 'dashboard'])->name('owner.dashboard');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('data_users');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create'); // Pastikan rute ini ada
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('products', [ProductController::class, 'index'])->name('data_product');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/search-user', [UserController::class, 'searchUser'])->name('search.user');
    Route::get('/search-product', [ProductController::class, 'searchProduct'])->name('search.product');

});

Route::middleware(['auth'])->prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/kasir', [KasirController::class, 'dashboard'])->name('dashboard'); // Mengarahkan ke method dashboard
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::post('transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/search-product', [ProductController::class, 'searchProduct'])->name('search.product');
    
});

Route::middleware(['auth'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/owner', [OwnerController::class, 'dashboard'])->name('dashboard'); // Mengarahkan ke method dashboard
    Route::get('products', [OwnerController::class, 'data_product'])->name('data_product');
    Route::get('users', [OwnerController::class, 'data_users'])->name('data_users');
    Route::get('/transaksi/riwayat', [OwnerController::class, 'history'])->name('transaksi.riwayat');
    Route::get('/search-user', [UserController::class, 'searchUser'])->name('search.user');
    Route::get('/admin/log-aktivitas', [OwnerController::class, 'log_activity'])->name('log_activity');
    Route::get('/search-product', [ProductController::class, 'searchProduct'])->name('search.product');
    Route::get('/search-transaction', [TransaksiController::class, 'searchTransaction'])->name('search.transaction');
});

