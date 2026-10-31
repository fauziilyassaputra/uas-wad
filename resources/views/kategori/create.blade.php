@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="form-wrap">
        <h1 class="page-title">Tambah Kategori</h1>

        <form action="{{ route('kategori.store') }}" method="POST" class="form form--spaced">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}">
                @error('name')
                    <small class="form-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea id="description" name="description" rows="4"
                          class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">{{ old('description') }}</textarea>
                @error('description')
                    <small class="form-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="actions">
                <button type="submit" class="btn"><span>Simpan</span></button>
                <a href="{{ route('kategori.index') }}" class="btn btn--secondary"><span>Batal</span></a>
            </div>
        </form>
    </div>
@endsection
