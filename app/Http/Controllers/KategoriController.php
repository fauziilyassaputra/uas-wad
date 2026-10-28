<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class KategoriController extends Controller
{
    private function dataKategori(): array
    {
    return [
        ['id' => 1, 'nama' => 'Elektronik'],
        ['id' => 2, 'nama' => 'Alat tulis'],
        ['id' => 3, 'nama' => 'Perabot'],
    ];
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = $this->dataKategori();
        return view('kategori.index', compact('kategori'));
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
        $request->validate([
            'nama' => 'required|string|max:100'
        ]);

        return redirect()
        ->route('kategori.index')
        ->with('success', 'kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = collect($this->dataKategori())->firstWhere('id', (int) $id);
        abort_if(is_null($kategori), 404);
        return view('kategori.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = collect($this->dataKategori())->firstWhere('id', (int) $id);
        abort_if(is_null($kategori), 404);
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100'
        ]);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'kategori berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()
            ->route('kategori.index')
            ->with('success', 'kategori berhasil dihapus');

    }
}
