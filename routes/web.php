<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Middleware\CatatAkses;
use App\Http\Middleware\CekToken;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/produk',[ProdukController::class, 'index'])
-> name('produk.index')
->middleware(CatatAkses::class)
;
// Route:produk
Route::resource('produk', ProdukController::class);


// Kategori 
Route::resource('kategori', KategoriController::class);

// AUTH
Route::middleware('guest')->group(function (){
   Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);


    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class , 'logout'])->name('logout');

    Route::resource('kategori', KategoriController::class);
    Route::resource('produk', ProdukController::class);
});