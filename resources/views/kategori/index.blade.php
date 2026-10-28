@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')

<h1>Daftar Kategori</h1>

<a href="{{ route('kategori.create') }}">Tambah Kategori</a>

<table border="1" cellpadding="6">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($kategori as $k )
            <tr>
                <td> {{ $k['id'] }} </td>
                <td> {{ $k['nama'] }} </td>
                <td>
                    <a href="{{ route('kategori.show', $k['id']) }}">Detail</a>
                    <a href="{{ route('kategori.edit', $k['id']) }}">Ubah</a>

                    <form action="{{ route('kategori.destroy', $k['id']) }}" method="POST" style="display: inline">
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