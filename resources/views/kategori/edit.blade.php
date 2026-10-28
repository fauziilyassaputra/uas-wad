@extends('layouts.app')

@section('title', 'Ubah Kategori')

@section('content')
    <h1>Ubah Kategori</h1>

    <form action="{{ route('kategori.update', $kategori['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama"
                   value="{{ old('nama', $kategori['nama']) }}">
            @error('nama')
                <small style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit">Perbarui</button>
        <a href="{{ route('kategori.index') }}">Batal</a>
    </form>
@endsection