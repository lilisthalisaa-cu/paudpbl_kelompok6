@extends('admin.layouts.app')

@section('title','Dashboard')

@section('hero')
@php $heroImage = asset('images/LogoPaud.jpeg'); @endphp

<div class="hero-wrap">
  <div class="hero-card">
    <div class="hero-inner">
      <div class="hero-bg" style="background-image:url('{{ $heroImage }}');">
        <div class="hero-overlay"></div>
        <div class="hero-content">
          <div class="hero-title">
            Dashboard Admin<br>
            <span style="color:#f59e0b;">KB Roudlotul Ilmi</span>
          </div>
          <div class="hero-sub">
            Kelola data guru, siswa, dan pantau rekap presensi dengan cepat.
          </div>
          <div class="hero-actions">
            <a class="btn-orange" style="text-decoration:none;display:inline-block;" href="{{ route('admin.teachers.index') }}">Kelola Guru</a>
            <a class="btn-ghost" href="{{ route('admin.students.index') }}">Kelola Siswa</a>
          </div>
        </div>
      </div>

      <div class="stats">
        <div class="stats-grid">
          <div class="stat">
            <small>Total Guru</small>
            <strong>{{ \App\Models\Teacher::count() }}</strong>
          </div>

          <div class="stat">
            <small>Total Siswa</small>
            <strong>{{ \App\Models\Student::count() }}</strong>
          </div>

          <div class="stat">
            <small>Presensi Hari Ini</small>

            <strong>
              {{
                \App\Models\StudentAttendance::whereDate('date', today())
                ->where('status', 'HADIR')
                ->count()
              }}
            </strong>

            <div style="margin-top:6px;color:#6b7280;font-size:12px;">
              Siswa hadir hari ini
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>
@endsection

@section('content')
{{-- kosong --}}
@endsection