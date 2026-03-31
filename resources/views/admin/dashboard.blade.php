@extends('admin.layouts.app')

@section('title','Dashboard')

@section('content')

@php
    $logo = asset('images/LogoPaud.jpeg');
@endphp

<style>
/* Hero Section */
.hero-wrap {
    background-color: #7f9aa3;
    border-radius: 15px;
    padding: 30px;
    color: white;
    margin-bottom: 20px;
    background-image: url('{{ $logo }}');
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
    position: relative;
}

.hero-overlay {
    position: absolute;
    top:0; left:0; right:0; bottom:0;
    background: rgba(0,0,0,0.2);
    border-radius: 15px;
}

.hero-content {
    position: relative;
    z-index: 1;
}

.hero-title {
    font-size: 24px;
    font-weight: bold;
}

.hero-title span {
    color: #f59e0b;
}

.hero-sub {
    font-size: 14px;
    margin: 10px 0;
}

/* Buttons */
.hero-actions a {
    display: inline-block;
    padding: 8px 20px;
    border-radius: 20px;
    margin-right: 10px;
    font-size: 14px;
    text-decoration: none;
}

.btn-orange {
    background-color: #f59e0b;
    color: white;
}

.btn-ghost {
    background-color: #ddd;
    color: #333;
}

/* Stats Cards */
.stats-grid {
    display: flex;
    gap: 20px;
    margin-top: 20px;
    flex-wrap: wrap;
}

.stat {
    background: #f5f5f5;
    flex: 1;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.stat small {
    display: block;
    font-size: 12px;
    color: #6b7280;
}

.stat strong {
    display: block;
    font-size: 20px;
    margin-top: 5px;
}

/* Responsive */
@media (max-width: 768px) {
    .stats-grid {
        flex-direction: column;
    }
}
</style>

<!-- HERO -->
<div class="hero-wrap">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-title">
            Dashboard Admin<br>
            <span>PAUD Raudhatul Ilmi</span>
        </div>
        <div class="hero-sub">
            Kelola data guru, siswa, dan pantau rekap absensi dengan cepat.
        </div>
        <div class="hero-actions">
            <a class="btn-orange" href="{{ route('admin.teachers.index') }}">Kelola Guru</a>
            <a class="btn-ghost" href="{{ route('admin.students.index') }}">Kelola Siswa</a>
        </div>
    </div>
</div>

<!-- STATS GRID -->
<div class="stats-grid">
    <!-- UI/UX Siti -->
    <div class="stat">
        <small>Total Guru (dummy)</small>
        <strong>-</strong>
    </div>
    <div class="stat">
        <small>Total Siswa (dummy)</small>
        <strong>-</strong>
    </div>
    <div class="stat">
        <small>Absensi Hari Ini</small>
        <div style="margin-top:6px;color:#6b7280;font-size:12px;">
            Akan terisi saat fitur input absensi aktif.
        </div>
    </div>

    <!-- Stat asli Lilis (tidak dihapus) -->
    <div class="stat">
      <small>Total Guru</small>
      <strong>-</strong>
    </div>

    <div class="stat">
      <small>Total Siswa</small>
      <strong>-</strong>
    </div>
</div>

@endsection