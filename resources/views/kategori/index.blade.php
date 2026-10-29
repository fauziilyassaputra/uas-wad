@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')

<h1>Daftar Kategori</h1>

<a href="{{ route('kategori.create') }}">Tambah Kategori</a>

<table border="1" cellpadding="6">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Jumlah Produk</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category )
            <tr>
                <td> {{ $category->name }} </td>
                <td> {{ $category->description }} </td>
                <td> {{ $category->products_count }} </td>
              
                <td>
                    <a href="{{ route('kategori.show', $category) }}"> Detail</a>
                    <a href="{{ route('kategori.edit', $category) }}"> Ubah</a>

                    <form action="{{ route('kategori.destroy', $category) }}" method="POST" style="display: inline" onsubmit="return confirm('Hapus Kategori ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
                
            </tr>
        @empty
            <tr>
                <td colspan="3">Belum ada kategori</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection