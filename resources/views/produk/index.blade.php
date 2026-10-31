@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Daftar Produk</h1>
        @can('manage-master')
            <a href="{{ route('produk.create') }}" class="btn"><span>Tambah Produk</span></a>
        @endcan
    </div>

    <div class="table-wrap">
        <table class="table">
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
                        <td class="table-strong">{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            <span>{{ $product->stock }} {{ $product->unit }}</span>
                            @if ($product->isLowStock())
                                <span class="badge badge--danger"><span>Menipis</span></span>
                            @endif
                        </td>
                        <td>
                            <div class="row-actions">
                                <a href="{{ route('produk.show', $product) }}" class="table-link"><span>Detail</span></a>
                                @can('manage-master')
                                    <a href="{{ route('produk.edit', $product) }}" class="table-link table-link--edit"><span>Ubah</span></a>
                                    <form action="{{ route('produk.destroy', $product) }}" method="POST" class="inline-form" onsubmit="return confirm('Hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="table-link table-link--danger">Hapus</button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="table-empty">Belum ada produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
