@extends('layouts.app')

@section('title', 'Ubah Produk')

@section('content')
    <div class="form-wrap">
        <h1 class="page-title">Ubah Produk</h1>

        <form action="{{ route('produk.update', $produk) }}" method="POST" class="form form--spaced">
            @csrf
            @method('PUT')

            @include('produk._form', ['product' => $produk])

            <div class="actions">
                <button type="submit" class="btn"><span>Perbarui</span></button>
                <a href="{{ route('produk.index') }}" class="btn btn--secondary"><span>Batal</span></a>
            </div>
        </form>
    </div>
@endsection
