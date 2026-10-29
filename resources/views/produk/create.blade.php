@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
    <h1>Tambah Produk</h1>

    <form action="{{ route('produk.store') }}" method="POST">
        @csrf

        @include('produk._form', ['product' => null])

        <button type="submit">Simpan</button>
        <a href="{{ route('produk.index') }}">Batal</a>
    </form>
@endsection