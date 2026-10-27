<?php

use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/produk',[ProdukController::class, 'index'])-> name('produk.index');

Route::get('/produk/{id}', fn ($id) => "detail produk $id")-> name('produk.show');