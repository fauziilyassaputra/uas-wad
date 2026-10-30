@extends('layouts.app')

@section('title', 'Registrasi')

@section('content')
    <h1>Registrasi</h1>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div>
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <small style="color:red">{{ $message }}</small>
            @enderror
        </div>

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
            <label for="password_confirmation">Konfirmasi password</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit">Daftar</button>
        <a href="{{ route('login') }}">Sudah punya akun?</a>
    </form>
@endsection