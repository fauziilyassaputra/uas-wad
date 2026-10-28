@extends('layouts.app')
@section('title', 'Daftar Produk')

@if (session('success'))
    <div style="background:#d4edda; padding:10px; margin-bottom:10px;">
        {{ session('success') }}
    </div>
@endif

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