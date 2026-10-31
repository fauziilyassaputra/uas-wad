<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard'); 

// Parameter {kategori} dan {produk} hanya boleh berisi angka, supaya tidak
// pernah "menelan" segmen literal seperti /create atau /edit.
Route::pattern('kategori', '[0-9]+');
Route::pattern('produk', '[0-9]+');

//  blm login
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
});

// User sudah login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    //  khusus admin
    //  WAJIB didaftarkan SEBELUM resource index/show di bawah, karena route
    //  {kategori}/{produk} akan menangkap segmen "create" bila urutannya
    //  terbalik sehingga halaman form create berakhir 404.
    Route::middleware('role:admin')->group(function () {
        Route::resource('kategori', KategoriController::class)->except(['index', 'show']);
        Route::resource('produk', ProdukController::class)->except(['index', 'show']);
    });

    // non admin
    Route::resource('kategori', KategoriController::class)->only(['index', 'show']);
    Route::resource('produk', ProdukController::class)->only(['index', 'show']);

    Route::resource('transaksi', TransaksiController::class)
        ->only(['index', 'create', 'store', 'show'])
        ->middleware('throttle:60,1');
});
