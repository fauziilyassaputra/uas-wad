@extends('layouts.app')

@section('title', 'Transaksi Stok')

@section('content')
    <h1>Transaksi Stok</h1>

    <a href="{{ route('transaksi.create') }}">Catat Transaksi</a>

    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>No. Referensi</th>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Produk</th>
                <th>Dicatat oleh</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $transaction)
                <tr>
                    <td> {{ $transaction->reference_no }} </td>
                    <td> {{ $transaction->transaction_date->format('D M Y') }} </td>
                    <td> {{ $transaction->typeLabel() }} </td>
                    <td>
                        @foreach ( $transaction->items as $item )
                            {{ $item->product->name }} ({{ $item->quantity }}) @if (! $loop->last), @endif
                        @endforeach
                    </td>
                    <td> {{ $transaction->user->name }} </td>
                    <td> <a href=" {{ route('transaksi.show', $transaction) }} ">Detail</a></td>
                </tr>
            @empty
                   <tr>
                    <td colspan="6"><em>Belum ada transaksi.</em></td>
                </tr>
            @endforelse
        </tbody>
@endsection