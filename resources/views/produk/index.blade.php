@extends('layouts.app')
@section('title', 'Daftar Produk')


@section('content')
    <h1>Daftar Produk</h1>
    <a href="{{ route('produk.create') }}">Tambah Produk</a>
    <ul>
        @forelse ($produk as $p)
            <li>
                <strong>{{ $p['nama'] }}</strong> - Rp {{ number_format($p['harga'], 0, ',', '.') }}
            </li>
        @empty
            <li>
                <em>Belum ada produk yang tersedia saat ini.</em>
            </li>
        @endforelse
    </ul>
@endsection