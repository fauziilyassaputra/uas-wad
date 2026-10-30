@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <h1>Login</h1>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
            @error('email')
                <small style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            @error('password')
                <small style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label>
                <input type="checkbox" name="remember"> Ingat saya
            </label>
        </div>

        <button type="submit">Masuk</button>
        <a href="{{ route('register') }}">Belum punya akun?</a>
    </form>
@endsection