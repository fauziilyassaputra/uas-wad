@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">{{ $kategori->name }}</h1>
            <p class="page-subtitle">{{ $kategori->description ?: 'Tidak ada deskripsi.' }}</p>
        </div>
    </div>

    <h2 class="section-title">Produk dalam kategori ini</h2>
    <ul class="item-list">
        @forelse ($kategori->products as $product)
            <li>
                <span class="item-name">{{ $product->name }}</span>
                <span class="text-muted">Stok: {{ $product->stock }} {{ $product->unit }}</span>
            </li>
        @empty
            <li class="table-empty">Belum ada produk.</li>
        @endforelse
    </ul>

    <div class="back-link">
        <a href="{{ route('kategori.index') }}" class="btn btn--secondary"><span>Kembali</span></a>
    </div>
@endsection
