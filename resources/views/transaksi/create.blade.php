@extends('layouts.app')

@section('title', 'Catat Transaksi')

@section('content')

  <h1>Catat Transaksi</h1>

  <form action="{{ route('transaksi.store') }}" method="POST">
    @csrf

    <div class="">
        <label for="type">Jenis</label>
        <select name="type" id="type">
              <option value="in"  @selected(old('type') === 'in')>Barang masuk</option>
                <option value="out" @selected(old('type') === 'out')>Barang keluar</option>

        </select>
            @error('type')
                <small style="color:red">{{ $message }}</small>
            @enderror
    </div>

    <div class="">
        <label for="product_id">Produk</label>
        <select name="product_id" id="product_id">
            <option value="">Pilih Produk :</option>
            @foreach ($products as $product )
            <option value="{{ $product->id }}" @selected(old('product_id') == $product->id)>
                 {{ $product->name }} (stok: {{ $product->stock }} {{ $product->unit }})
            </option>
            @endforeach
        </select>
            @error('product_id')
                <small style="color:red">{{ $message }}</small>
            @enderror
    </div>

    <div>
            <label for="quantity">Jumlah</label>
            <input type="number" id="quantity" name="quantity" min="1" value="{{ old('quantity') }}">
            @error('quantity')
                <small style="color:red">{{ $message }}</small>
            @enderror
    </div>
    
    <div class="">
        <label for="transaction_date">Tanggal</label>
        <input type="date" id="transaction_date" name="transaction_date" value="{{ old('transaction_date', now()->toDateString()) }}" >
        @error('transaction_date')
            <small style="color: red"> {{ $message }} </small>
        @enderror
    </div>

     <div>
            <label for="note">Catatan</label>
            <textarea id="note" name="note">{{ old('note') }}</textarea>
            @error('note')
                <small style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit">Simpan</button>
        <a href="{{ route('transaksi.index') }}">Batal</a>

  </form>



@endsection