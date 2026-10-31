@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
    <div class="form-wrap">
        <h1 class="page-title">Tambah Produk</h1>

        <form action="{{ route('produk.store') }}" method="POST" class="form form--spaced">
            @csrf

            @include('produk._form', ['product' => null])

            <div class="actions">
                <button type="submit" class="btn"><span>Simpan</span></button>
                <a href="{{ route('produk.index') }}" class="btn btn--secondary"><span>Batal</span></a>
            </div>
        </form>
    </div>
@endsection
