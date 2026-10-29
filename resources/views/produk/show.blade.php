@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
    <h1>{{ $produk->name }}</h1>

    <ul>
        <li>SKU: {{ $produk->sku }}</li>
        <li>Kategori: {{ $produk->category->name }}</li>
        <li>Stok: {{ $produk->stock }} {{ $produk->unit }}</li>
        <li>Batas minimum: {{ $produk->min_stock }}</li>
    </ul>

    @if ($produk->isLowStock())
        <p style="color:red">Stok produk ini sudah menipis.</p>
    @endif

    <a href="{{ route('produk.index') }}">Kembali</a>
@endsection