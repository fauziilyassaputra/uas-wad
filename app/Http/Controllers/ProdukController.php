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
    public function create(){
        return view('produk.create');
    }

    public function store(Request $request)
    {
      
        //   return redirect()
        // ->route('produk.index')
        // ->with('success', 'Produk berhasil ditambahkan.');
        $request->validate([
    'nama'  => 'required|string|max:100',
    'harga' => 'required|integer|min:0',
]);
    }

}
