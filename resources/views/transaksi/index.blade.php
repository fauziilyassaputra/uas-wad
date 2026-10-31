@extends('layouts.app')

@section('title', 'Transaksi Stok')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Transaksi Stok</h1>
        <a href="{{ route('transaksi.create') }}" class="btn"><span>Catat Transaksi</span></a>
    </div>

    <div class="table-wrap">
        <table class="table">
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
                        <td class="table-strong">{{ $transaction->reference_no }}</td>
                        <td>{{ $transaction->transaction_date->format('D M Y') }}</td>
                        <td>{{ $transaction->typeLabel() }}</td>
                        <td>
                            @foreach ($transaction->items as $item)
                                {{ $item->product->name }} ({{ $item->quantity }})@if (! $loop->last), @endif
                            @endforeach
                        </td>
                        <td>{{ $transaction->user->name }}</td>
                        <td>
                            <a href="{{ route('transaksi.show', $transaction) }}" class="table-link"><span>Detail</span></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="table-empty">Belum ada transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
