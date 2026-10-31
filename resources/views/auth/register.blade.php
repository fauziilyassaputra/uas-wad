@extends('layouts.app')

@section('title', 'Registrasi')

@section('content')
    <div class="form-narrow">
        <h1 class="auth-title">Registrasi</h1>
        <p class="auth-subtitle">Buat akun baru untuk mulai menggunakan aplikasi.</p>

        <form action="{{ route('register') }}" method="POST" class="form auth-form">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}">
                @error('name')
                    <small class="form-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}">
                @error('email')
                    <small class="form-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password"
                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                @error('password')
                    <small class="form-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Konfirmasi password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
            </div>

            <div class="actions">
                <button type="submit" class="btn"><span>Daftar</span></button>
                <a href="{{ route('login') }}">Sudah punya akun?</a>
            </div>
        </form>
    </div>
@endsection
