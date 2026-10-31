@extends('layouts.app')

@section('title', 'Akses Ditolak')

@section('content')
    <div class="error-page">
        <p class="error-code">403</p>
        <h1 class="auth-title">Akses ditolak</h1>
        <p class="auth-subtitle">{{ isset($exception) && $exception->getMessage() ? $exception->getMessage() : 'Anda tidak memiliki akses ke halaman ini.' }}</p>
        <a href="{{ route('dashboard') }}" class="btn"><span>Kembali ke dashboard</span></a>
    </div>
@endsection
