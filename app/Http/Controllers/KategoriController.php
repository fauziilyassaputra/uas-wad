<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $categories = Category::withCount('products')
            ->orderBy('name')
            ->get();
        return view('kategori.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data = $request->validate([
         'name'        => 'required|string|max:100|unique:categories,name',
            'description' => 'nullable|string|max:255',
       ]);
       Category::create($data);
       return redirect()
        ->route('kategori.index')
        ->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $kategori)
    {
       $kategori->load('products');

        return view('kategori.show', compact('kategori'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $kategori)
    {
       
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $kategori)
    {
        $data = $request->validate([
            'name' => [
                'required', 'string', 'max:100',
                Rule::unique('categories','name')->ignore($kategori->id),
            ],
            'description' => 'nullable|string|max:255'
        ]);

        $kategori->update($data);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'kategori berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $kategori)
    {
        if ($kategori->products()->exists()){
            return redirect()
            ->route('kategori.index')
            ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki produk.');
        }

        $kategori->delete();
        return redirect()
            ->route('kategori.index')
            ->with('success', 'kategori berhasil dihapus');

    }
}
