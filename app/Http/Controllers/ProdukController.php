<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = [
            ['id' => 1, 'nama' => 'Laptop', 'harga' => 8000000],
            ['id' => 2, 'nama' => 'Keyboard', 'harga' => 700000],
        ];
        return view('produk.index', compact('produk'));
    }
}
