
@extends('parent.layouts.app')

@section('title', 'Dashboard Orang Tua')

@section('content')

<div class="card parent-dashboard-card">

    <div class="card-head">
        <div>
            <h2 class="card-title">
                Dashboard Orang Tua 👋
            </h2>

            <div class="muted">
                Selamat datang,
                <strong>{{ $parent->name }}</strong>
            </div>
        </div>
    </div>

    <div class="grid teacher-grid">

        {{-- Informasi Anak --}}
        <a href="{{ route('parent.student') }}"
           class="card-menu">

            <div style="font-size:30px;">
                👦
            </div>

            <span class="menu-title">
                Informasi Anak
            </span>

            <div class="card-action">
                Lihat Data →
            </div>
        </a>

        {{-- Perkembangan Anak --}}
        <a href="{{ route('parent.development') }}"
           class="card-menu">

            <div style="font-size:30px;">
                📈
            </div>

            <span class="menu-title">
                Perkembangan Anak
            </span>

            <div class="card-action">
                Lihat Perkembangan →
            </div>
        </a>

        {{-- Kegiatan Harian --}}
        <a href="{{ route('parent.activity') }}"
           class="card-menu">

            <div style="font-size:30px;">
                📘
            </div>

            <span class="menu-title">
                Kegiatan Harian
            </span>

            <div class="card-action">
                Lihat Kegiatan →
            </div>
        </a>

        {{-- Pembayaran SPP --}}
        <a href="{{ route('parent.payment') }}"
           class="card-menu">

            <div style="font-size:30px;">
                💳
            </div>

            <span class="menu-title">
                Pembayaran SPP
            </span>

            <div class="card-action">
                Lihat Pembayaran →
            </div>
        </a>

        {{-- Kalender Akademik --}}
        <a href="{{ route('parent.academic-calendars.index') }}"
           class="card-menu">

            <div style="font-size:30px;">
                📅
            </div>

            <span class="menu-title">
                Kalender Akademik
            </span>

            <div class="card-action">
                Lihat Kalender →
            </div>
        </a>

    </div>

</div>

@endsection
