@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')
<h1> {{ $kategori['nama'] }} </h1>
<h1>ID: {{ $kategori['id'] }} </h1>
<a href="{{ route('kategori.index') }}">Kembali</a>