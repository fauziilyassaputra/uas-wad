@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <h1>Daftar Produk</h1>


    @can('manage-master')
    <a href="{{ route('produk.create') }}">Tambah Produk</a>
    @endcan

    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>SKU</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>
                        {{ $product->stock }} {{ $product->unit }}
                        @if ($product->isLowStock())
                            <strong style="color:red">(menipis)</strong>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('produk.show', $product) }}">Detail</a>
                        @can('manage-master')
                        <a href="{{ route('produk.edit', $product) }}">Ubah</a>
                        <form action="{{ route('produk.destroy', $product) }}"
                        method="POST" style="display:inline"
                        onsubmit="return confirm('Hapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                        </form>
                        @endcan
                       
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5"><em>Belum ada produk.</em></td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection