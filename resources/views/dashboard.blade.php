@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1>Dashboard</h1>
    <p>Selamat datang, {{ auth()->user()->name }}.</p>

    <div style="display:flex; gap:12px; flex-wrap:wrap; margin-bottom:20px;">
        <div style="border:1px solid #ccc; padding:12px; min-width:150px;">
            <small>Total Produk</small>
            <h2>{{ $totalProducts }}</h2>
        </div>
        <div style="border:1px solid #ccc; padding:12px; min-width:150px;">
            <small>Total Kategori</small>
            <h2>{{ $totalCategories }}</h2>
        </div>
        <div style="border:1px solid #ccc; padding:12px; min-width:150px;">
            <small>Total Unit di Stok</small>
            <h2>{{ number_format($totalStock, 0, ',', '.') }}</h2>
        </div>
        <div style="border:1px solid #ccc; padding:12px; min-width:150px;">
            <small>Stok Menipis</small>
            <h2 style="color:{{ $lowStockCount > 0 ? 'red' : 'inherit' }}">{{ $lowStockCount }}</h2>
        </div>
    </div>

    <h2>Pergerakan stok 30 hari terakhir</h2>
    <ul>
        <li>Barang masuk: <strong>{{ number_format($totalIn, 0, ',', '.') }}</strong> unit</li>
        <li>Barang keluar: <strong>{{ number_format($totalOut, 0, ',', '.') }}</strong> unit</li>
    </ul>

    <h2>Produk dengan stok menipis</h2>
    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>SKU</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Batas minimum</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($lowStockProducts as $product)
                <tr>
                    <td>{{ $product->sku }}</td>
                    <td><a href="{{ route('produk.show', $product) }}">{{ $product->name }}</a></td>
                    <td>{{ $product->category->name }}</td>
                    <td style="color:red">{{ $product->stock }} {{ $product->unit }}</td>
                    <td>{{ $product->min_stock }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5"><em>Semua stok aman.</em></td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h2>Transaksi terakhir</h2>
    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>No. Referensi</th>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Produk</th>
                <th>Dicatat oleh</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($recentTransactions as $transaction)
                <tr>
                    <td><a href="{{ route('transaksi.show', $transaction) }}">{{ $transaction->reference_no }}</a></td>
                    <td>{{ $transaction->transaction_date->format('d M Y') }}</td>
                    <td>{{ $transaction->typeLabel() }}</td>
                    <td>
                        @foreach ($transaction->items as $item)
                            {{ $item->product->name }} ({{ $item->quantity }})@if (! $loop->last), @endif
                        @endforeach
                    </td>
                    <td>{{ $transaction->user->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5"><em>Belum ada transaksi.</em></td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p>
        <a href="{{ route('transaksi.create') }}">Catat Transaksi</a>
        @can('manage-master')
            | <a href="{{ route('produk.create') }}">Tambah Produk</a>
        @endcan
    </p>
@endsection