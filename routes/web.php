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
// Route::get('/produk/{id}', fn ($id) => "detail produk $id")-> name('produk.show');

Route::get('/produk/create',[ProdukController::class, 'create'])
-> name('produk.create')
->middleware(CekToken::class)
;
Route::post('/produk',[ProdukController::class, 'store'])-> name('produk.store');


// Kategori 
Route::resource('kategori', KategoriController::class);