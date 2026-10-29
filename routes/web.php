<?php

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