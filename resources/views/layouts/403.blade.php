@extends('layouts.app')

@section('title', 'Akses Ditolak')

@section('content')
    <h1>403 - Akses ditolak</h1>
    <p>{{ $exception->getMessage() ?: 'Anda tidak memiliki akses ke halaman ini.' }}</p>
    <a href="{{ route('produk.index') }}">Kembali ke daftar produk</a>
@endsection