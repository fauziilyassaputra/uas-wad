@extends('layouts.app')

@section('title', 'Ubah Produk')

@section('content')
    <h1>Ubah Produk</h1>

    <form action="{{ route('produk.update', $produk) }}" method="POST">
        @csrf
        @method('PUT')

        @include('produk._form', ['product' => $produk])

        <button type="submit">Perbarui</button>
        <a href="{{ route('produk.index') }}">Batal</a>
    </form>
@endsection