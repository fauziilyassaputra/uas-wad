@extends('layouts.app')

@section('title', 'Ubah Kategori')

@section('content')
    <h1>Ubah Kategori</h1>

    <form action="{{ route('kategori.update', $kategori) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Nama</label>
            <input type="text" id="name" name="name"
                   value="{{ old('name', $kategori->name) }}">
            @error('name')
                <small style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="description">Deskripsi</label>
            <textarea id="description" name="description">{{ old('description', $kategori->description) }}</textarea>
            @error('description')
                <small style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit">Perbarui</button>
        <a href="{{ route('kategori.index') }}">Batal</a>
    </form>
@endsection