<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProdukController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->orderBy('name')
            ->get();
            return view('produk.index', compact('products'));
    }
    public function create(){
        $categories = Category::orderBy('name')->get();
        return view('produk.create', compact('categories'));
    }

    public function store(Request $request)
    {
      $data = $request->validate([
         'category_id' => 'required|exists:categories,id',
            'sku'         => 'required|string|max:50|unique:products,sku',
            'name'        => 'required|string|max:150',
            'unit'        => 'required|string|max:20',
            'min_stock'   => 'required|integer|min:0',
      ]);
      Product::create($data);
      return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }
     public function show(Product $produk)
    {
        $produk->load('category');

        return view('produk.show', compact('produk'));
    }

    public function edit(Product $produk)
    {
        $categories = Category::orderBy('name')->get();

        return view('produk.edit', compact('produk', 'categories'));
    }
    public function update(Request $request, Product $produk)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sku'         => [
                'required', 'string', 'max:50',
                Rule::unique('products', 'sku')->ignore($produk->id),
            ],
            'name'        => 'required|string|max:150',
            'unit'        => 'required|string|max:20',
            'min_stock'   => 'required|integer|min:0',
        ]);

        $produk->update($data);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }
    public function destroy(Product $produk)
    {
        if ($produk->transactionItems()->exists()) {
            return redirect()
                ->route('produk.index')
                ->with('error', 'Produk tidak dapat dihapus karena sudah memiliki riwayat transaksi.');
        }

        $produk->delete();

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

}
