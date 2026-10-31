@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="form-narrow">
        <h1 class="auth-title">Login</h1>
        <p class="auth-subtitle">Masuk untuk mengelola data stok.</p>

        <form action="{{ route('login') }}" method="POST" class="form auth-form">
            @csrf

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

            <div class="form-check-row">
                <label class="form-check">
                    <input type="checkbox" name="remember">
                    Ingat saya
                </label>
            </div>

            <div class="actions">
                <button type="submit" class="btn"><span>Masuk</span></button>
                <a href="{{ route('register') }}">Belum punya akun?</a>
            </div>
        </form>
    </div>
@endsection
