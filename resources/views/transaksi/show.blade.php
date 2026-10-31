@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
    <h1>{{ $transaksi->reference_no }}</h1>

    <ul>
        <li>Jenis: {{ $transaksi->typeLabel() }}</li>
        <li>Tanggal: {{ $transaksi->transaction_date->format('d M Y') }}</li>
        <li>Dicatat oleh: {{ $transaksi->user->name }}</li>
        <li>Catatan: {{ $transaksi->note ?: '-' }}</li>
    </ul>

    <table border="1" cellpadding="6">
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
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }} {{ $item->product->unit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('transaksi.index') }}">Kembali</a>
@endsection