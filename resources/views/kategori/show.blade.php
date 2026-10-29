@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')
<h1> {{ $kategori->name }} </h1>
<h1>ID: {{ $kategori->description ?: 'tidak ada deskripsi.' }} </h1>

<h2>Produk dalam kategori ini</h2>
<ul>
    @forelse ($kategori->products as $product )
        <li> {{ $product->name }} (stok: {{ $product->stock }} {{ $product->unit }}) </li>
    @empty
         <li><em>Belum ada produk.</em></li>
    @endforelse
</ul>

<a href="{{ route('kategori.index') }}">Kembali</a>
@endsection