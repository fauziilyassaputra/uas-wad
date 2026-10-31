@extends('layouts.app')

@section('title', 'Akses Ditolak')

@section('content')
    <h1>403 - Akses ditolak</h1>
    <p>{{ isset($exception) && $exception->getMessage() ? $exception->getMessage() : 'Anda tidak memiliki akses ke halaman ini.' }}</p>
    <a href="{{ route('dashboard') }}">Kembali ke dashboard</a>
@endsection