@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<h1>Tambah Produk</h1>

<form action="{{  route('produk.store') }}" method="POST">
    @csrf

    <div class="">
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama') }}">
        @error('nama')
    <small style="color:red">{{ $message }}</small>
        @enderror
    </div>

    <div class="">
        <label for="harga">Harga</label>
        <input type="text" id="harga" name="harga" value="{{ old('harga') }}">
        @error('harga')
    <small style="color:red">{{ $message }}</small>
        @enderror
    </div>

    <button type="submit">Simpan</button>
</form>
@endsection