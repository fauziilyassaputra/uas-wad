<?php

use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/produk',[ProdukController::class, 'index'])-> name('produk.index');
// Route::get('/produk/{id}', fn ($id) => "detail produk $id")-> name('produk.show');

Route::get('/produk/create',[ProdukController::class, 'create'])-> name('produk.create');
Route::post('/produk',[ProdukController::class, 'store'])-> name('produk.store');
