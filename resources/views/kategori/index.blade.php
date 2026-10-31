@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Daftar Kategori</h1>
        @can('manage-master')
            <a href="{{ route('kategori.create') }}" class="btn"><span>Tambah Kategori</span></a>
        @endcan
    </div>

    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Produk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td class="table-strong">{{ $category->name }}</td>
                        <td class="text-muted">{{ $category->description }}</td>
                        <td>
                            <span class="badge badge--count"><span>{{ $category->products_count }}</span></span>
                        </td>
                        <td>
                            <div class="row-actions">
                                <a href="{{ route('kategori.show', $category) }}" class="table-link"><span>Detail</span></a>
                                @can('manage-master')
                                    <a href="{{ route('kategori.edit', $category) }}" class="table-link table-link--edit"><span>Ubah</span></a>
                                    <form action="{{ route('kategori.destroy', $category) }}" method="POST" class="inline-form" onsubmit="return confirm('Hapus Kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="table-link table-link--danger">Hapus</button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="table-empty">Belum ada kategori</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
