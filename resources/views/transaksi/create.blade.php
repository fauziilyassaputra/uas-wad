@extends('layouts.app')

@section('title', 'Catat Transaksi')

@section('content')
    <div class="form-wrap">
        <h1 class="page-title">Catat Transaksi</h1>

        <form action="{{ route('transaksi.store') }}" method="POST" class="form form--spaced">
            @csrf

            <div class="form-group">
                <label for="type" class="form-label">Jenis</label>
                <select name="type" id="type"
                        class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}">
                    <option value="in" @selected(old('type') === 'in')>Barang masuk</option>
                    <option value="out" @selected(old('type') === 'out')>Barang keluar</option>
                </select>
                @error('type')
                    <small class="form-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="product_id" class="form-label">Produk</label>
                <select name="product_id" id="product_id"
                        class="form-control{{ $errors->has('product_id') ? ' is-invalid' : '' }}">
                    <option value="">Pilih Produk :</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" @selected(old('product_id') == $product->id)>
                            {{ $product->name }} (stok: {{ $product->stock }} {{ $product->unit }})
                        </option>
                    @endforeach
                </select>
                @error('product_id')
                    <small class="form-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="quantity" class="form-label">Jumlah</label>
                <input type="number" id="quantity" name="quantity" min="1" value="{{ old('quantity') }}"
                       class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}">
                @error('quantity')
                    <small class="form-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="transaction_date" class="form-label">Tanggal</label>
                <input type="date" id="transaction_date" name="transaction_date" value="{{ old('transaction_date', now()->toDateString()) }}"
                       class="form-control{{ $errors->has('transaction_date') ? ' is-invalid' : '' }}">
                @error('transaction_date')
                    <small class="form-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="note" class="form-label">Catatan</label>
                <textarea id="note" name="note" rows="3"
                          class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}">{{ old('note') }}</textarea>
                @error('note')
                    <small class="form-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="actions">
                <button type="submit" class="btn"><span>Simpan</span></button>
                <a href="{{ route('transaksi.index') }}" class="btn btn--secondary"><span>Batal</span></a>
            </div>
        </form>
    </div>
@endsection
