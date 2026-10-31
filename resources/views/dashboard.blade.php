@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Dashboard</h1>
            <p class="page-subtitle">Selamat datang, {{ auth()->user()->name }}.</p>
        </div>
    </div>

    <div class="stat-grid">
        <div class="stat-card">
            <p class="stat-label">Total Produk</p>
            <p class="stat-value">{{ $totalProducts }}</p>
        </div>
        <div class="stat-card">
            <p class="stat-label">Total Kategori</p>
            <p class="stat-value">{{ $totalCategories }}</p>
        </div>
        <div class="stat-card">
            <p class="stat-label">Total Unit di Stok</p>
            <p class="stat-value">{{ number_format($totalStock, 0, ',', '.') }}</p>
        </div>
        <div class="stat-card stat-card--alert">
            <p class="stat-label">Stok Menipis</p>
            <p class="stat-value{{ $lowStockCount > 0 ? ' stat-value--alert' : '' }}">{{ $lowStockCount }}</p>
        </div>
    </div>

    <section class="section">
        <h2 class="section-title">Pergerakan stok 30 hari terakhir</h2>
        <div class="flow-grid">
            <div class="flow-box flow-box--in">
                Barang masuk: <strong>{{ number_format($totalIn, 0, ',', '.') }}</strong> unit
            </div>
            <div class="flow-box flow-box--out">
                Barang keluar: <strong>{{ number_format($totalOut, 0, ',', '.') }}</strong> unit
            </div>
        </div>
    </section>

    <section class="section">
        <h2 class="section-title">Produk dengan stok menipis</h2>
        <div class="table-wrap">
            <table class="table">
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
                            <td><a href="{{ route('produk.show', $product) }}" class="table-strong">{{ $product->name }}</a></td>
                            <td>{{ $product->category->name }}</td>
                            <td><span class="text-danger table-strong">{{ $product->stock }} {{ $product->unit }}</span></td>
                            <td>{{ $product->min_stock }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="table-empty">Semua stok aman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section class="section">
        <h2 class="section-title">Transaksi terakhir</h2>
        <div class="table-wrap">
            <table class="table">
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
                            <td><a href="{{ route('transaksi.show', $transaction) }}" class="table-strong">{{ $transaction->reference_no }}</a></td>
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
                            <td colspan="5" class="table-empty">Belum ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <div class="actions actions--spaced">
        <a href="{{ route('transaksi.create') }}" class="btn"><span>Catat Transaksi</span></a>
        @can('manage-master')
            <a href="{{ route('produk.create') }}" class="btn btn--secondary"><span>Tambah Produk</span></a>
        @endcan
    </div>
@endsection
