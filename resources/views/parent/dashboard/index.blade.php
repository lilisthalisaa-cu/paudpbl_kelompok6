@extends('parent.layouts.app')

@section('title', 'Dashboard Orang Tua')

@section('content')

<div class="container dashboard-page"> <!-- 🔥 INI KUNCI -->

  <div class="card parent-card">

    <div class="card-head">
      <div>
        <h2 class="card-title">Dashboard Orang Tua 👋</h2>

         <div class="muted">
        Selamat datang, <strong>{{ $parent->name ?? 'Orang Tua' }}</strong>
        </div>
      </div>
    </div>

    <div class="stats-grid parent-grid">

      <a href="{{ route('parent.student') }}" class="parent-menu">
        <small>Informasi Anak</small>
        <p>Lihat Data →</p>
      </a>

      <a href="{{ route('parent.development') }}" class="parent-menu">
        <small>Perkembangan Anak</small>
        <p>Lihat Perkembangan →</p>
      </a>

      <a href="{{ route('parent.activity') }}" class="parent-menu">
        <small>Kegiatan Harian</small>
        <p>Lihat Kegiatan →</p>
      </a>

      <a href="{{ route('parent.payment') }}" class="parent-menu">
        <small>Pembayaran SPP</small>
        <p>Lihat Pembayaran →</p>
      </a>

    </div>

  </div>

</div>

@endsection