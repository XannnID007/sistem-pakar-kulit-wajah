@extends('layouts.app')

@section('content')
<div class="container">
    <div class="welcome">
        <h2>Selamat Datang, {{ Auth::user()->name }}</h2>
        <p>Silakan memilih menu untuk memulai konsultasi atau melihat hasil sebelumnya.</p>
    </div>

    <div class="illustration">
        <img src="{{ asset('images/bg.png') }}" alt="Dokter Ilustrasi" width="350">
    </div>
</div>

<div class="menu">
    <a href="{{ route('diagnosa.data_form') }}">
        <div class="menu-icon">📝</div>
        Mulai Diagnosa
    </a>
    <a href="#">
        <div class="menu-icon">📜</div>
        Riwayat Diagnosa
    </a>
</div>
@endsection
