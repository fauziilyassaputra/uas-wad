@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
    <div class="page-header">
        <div class="detail-title">
            <h1 class="page-title">{{ $produk->name }}</h1>
            @if ($produk->isLowStock())
                <span class="badge badge--danger"><span>Stok menipis</span></span>
            @endif
        </div>
    </div>

    <dl class="detail-grid">
        <div class="detail-item">
            <dt>SKU</dt>
            <dd>{{ $produk->sku }}</dd>
        </div>
        <div class="detail-item">
            <dt>Kategori</dt>
            <dd>{{ $produk->category->name }}</dd>
        </div>
        <div class="detail-item">
            <dt>Stok</dt>
            <dd>{{ $produk->stock }} {{ $produk->unit }}</dd>
        </div>
        <div class="detail-item">
            <dt>Batas minimum</dt>
            <dd>{{ $produk->min_stock }}</dd>
        </div>
    </dl>

    <div class="back-link">
        <a href="{{ route('produk.index') }}" class="btn btn--secondary"><span>Kembali</span></a>
    </div>
@endsection
