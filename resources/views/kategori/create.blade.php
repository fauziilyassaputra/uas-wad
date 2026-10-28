@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<h1>Tambah Kategori</h1>

<form action="{{ route("kategori.store") }}" method="POST">
    @csrf
    <div class="">
        <label for="nama">nama</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama') }}">
        @error('nama')

        <small style="color: red"> {{ $message }} </small>    
        @enderror
    </div>
    <button type="submit">Simpan</button>
    <a href="{{ route('kategori.index') }}">Batal</a>
</form>
@endsection

