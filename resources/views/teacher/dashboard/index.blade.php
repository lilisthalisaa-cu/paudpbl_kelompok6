@extends('teacher.layouts.app')

@section('title','Dashboard Teacher')

@section('content')

<style>
.grid {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 18px;
}

.card-menu {
  background: #fff;
  border-radius: 14px;
  padding: 18px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.04);
  transition: 0.2s;
  border: 1px solid #f3f4f6;
}

.card-menu:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}

.icon {
  font-size: 20px;
  margin-bottom: 6px;
}
</style>

<div class="card">

  @if(session('success'))
    <div style="
      background:#d1fae5;
      padding:12px;
      border-radius:10px;
      margin-bottom:16px;
      color:#065f46;
      font-weight:500;
    ">
      {{ session('success') }}
    </div>
  @endif

  <div class="card-head">
    <div>
      <h2 class="card-title">Dashboard Teacher 👋</h2>
      <div class="muted">
        Selamat datang, <strong>{{ auth()->user()->name ?? 'Teacher' }}</strong>
      </div>
    </div>
  </div>

  <div class="grid">

    <div class="card-menu">
      <div class="icon">👨‍🎓</div>
      <div class="menu-title">Data Siswa</div>
      <a href="{{ route('teacher.students.index') }}" class="card-action">
        Lihat Data →
      </a>
    </div>

    <div class="card-menu">
      <div class="icon">🧑‍🏫</div>
      <div class="menu-title">Presensi Guru</div>
      <a href="{{ route('teacher.attendance.create') }}" class="card-action">
        Buka Form →
      </a>
    </div>

    <div class="card-menu">
      <div class="icon">👦</div>
      <div class="menu-title">Presensi Siswa</div>
      <a href="{{ route('teacher.student_attendance.bulk_create') }}" class="card-action">
        Buka Form →
      </a>
    </div>

    <div class="card-menu">
      <div class="icon">📘</div>
      <div class="menu-title">Kegiatan Harian</div>
      <a href="{{ route('teacher.activity.create') }}" class="card-action">
        Buka Form →
      </a>
    </div>

    <div class="card-menu">
      <div class="icon">📈</div>
      <div class="menu-title">Perkembangan Anak</div>
      <a href="{{ route('teacher.development.create') }}" class="card-action">
        Buka Form →
      </a>
    </div>

  </div>
</div>

@endsection