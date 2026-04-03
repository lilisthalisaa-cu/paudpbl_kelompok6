@extends('layouts.app')

@section('title','Dashboard Guru')

@section('hero')
@php $heroImage = asset('images/LogoPaud.jpeg'); @endphp

<div class="hero-wrap">
  <div class="hero-card">
    <div class="hero-inner">
      <div class="hero-bg" style="background-image:url('{{ $heroImage }}');">
        <div class="hero-overlay"></div>

        <div class="hero-content">
          <div class="hero-title">
            Dashboard Guru<br>
            <span style="color:#f59e0b;">PAUD Raudhatul Ilmi</span>
          </div>

          <div class="hero-sub">
            Kelola absensi dan perkembangan siswa dengan mudah.
          </div>

          {{--  FITUR UTAMA --}}
          <div class="hero-actions">
            <a class="btn-orange" href="#">Absensi Guru</a>
            <a class="btn-ghost" href="#">Absensi Siswa</a>
            <a class="btn-ghost" href="#">Kegiatan Harian</a>
            <a class="btn-ghost" href="#">Perkembangan Bulanan</a>
          </div>
        </div>
      </div>

      {{--  STATISTIK --}}
      <div class="stats">
        <div class="stats-grid">

          <div class="stat">
            <small>Total Siswa</small>
            <strong>30</strong>
          </div>

          <div class="stat">
            <small>Hadir Hari Ini</small>
            <strong>25</strong>
          </div>

          <div class="stat">
            <small>Tidak Hadir</small>
            <strong>5</strong>
          </div>

          <div class="stat">
            <small>Kegiatan Hari Ini</small>
            <strong>3 Kegiatan</strong>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>
@endsection

@section('content')

<div class="container mt-4">

  {{--  MENU FITUR DETAIL --}}
  <h3>Menu Aktivitas Guru</h3>

  <div class="row">

    <div class="col">
      <div class="card">
        <h4>Absensi Guru</h4>
        <p>Catat kehadiran guru harian</p>
        <a href="#">Input</a>
      </div>
    </div>

    <div class="col">
      <div class="card">
        <h4>Absensi Siswa</h4>
        <p>Kelola kehadiran siswa</p>
        <a href="#">Input</a>
      </div>
    </div>

    <div class="col">
      <div class="card">
        <h4>Kegiatan Harian</h4>
        <p>Catat aktivitas belajar siswa</p>
        <a href="#">Input</a>
      </div>
    </div>

    <div class="col">
      <div class="card">
        <h4>Perkembangan Bulanan</h4>
        <p>Laporan perkembangan siswa</p>
        <a href="#">Input</a>
      </div>
    </div>

  </div>

  {{--  DATA SISWA --}}
  <hr>

  <h3>Data Siswa</h3>

  <table class="table">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Budi</td>
        <td>A</td>
        <td><span style="color:green;">Hadir</span></td>
      </tr>
      <tr>
        <td>Siti</td>
        <td>A</td>
        <td><span style="color:orange;">Izin</span></td>
      </tr>
    </tbody>
  </table>

</div>

@endsection