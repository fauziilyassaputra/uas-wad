@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
    <div class="page-header">
        <h1 class="page-title">{{ $transaksi->reference_no }}</h1>
    </div>

    <dl class="detail-grid">
        <div class="detail-item">
            <dt>Jenis</dt>
            <dd>{{ $transaksi->typeLabel() }}</dd>
        </div>
        <div class="detail-item">
            <dt>Tanggal</dt>
            <dd>{{ $transaksi->transaction_date->format('d M Y') }}</dd>
        </div>
        <div class="detail-item">
            <dt>Dicatat oleh</dt>
            <dd>{{ $transaksi->user->name }}</dd>
        </div>
        <div class="detail-item">
            <dt>Catatan</dt>
            <dd>{{ $transaksi->note ?: '-' }}</dd>
        </div>
    </dl>

    <h2 class="section-title section">Item transaksi</h2>
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi->items as $item)
                    <tr>
                        <td>{{ $item->product->sku }}</td>
                        <td class="table-strong">{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }} {{ $item->product->unit }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="back-link">
        <a href="{{ route('transaksi.index') }}" class="btn btn--secondary"><span>Kembali</span></a>
    </div>
@endsection
