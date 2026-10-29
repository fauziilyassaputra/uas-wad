@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<h1>Tambah Kategori</h1>

<form action="{{ route("kategori.store") }}" method="POST">
    @csrf
    <div class="">
        <label for="name">nama</label>
        <input type="text" id="nama" name="name" value="{{ old('name') }}">
        @error('name')
        <small style="color: red"> {{ $message }} </small>    
        @enderror
    </div>

    <div class="">
        <label for="description">Deskripsi</label>
        <textarea  id="nama" name="description" value="{{ old('description') }}" ></textarea>
        @error('deskription')

        <small style="color: red"> {{ $message }} </small>    
        @enderror
    </div>
    <button type="submit">Simpan</button>
    <a href="{{ route('kategori.index') }}">Batal</a>
</form>
@endsection

