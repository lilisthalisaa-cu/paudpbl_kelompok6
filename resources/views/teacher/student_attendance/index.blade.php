@extends('teacher.layouts.app')

@section('title', 'Data Absensi Siswa')

@section('content')

<style>

/* 🔥 HANYA UNTUK INDEX (AMAN) */
.card-title {
  font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif !important;
  font-weight: 800 !important;
  font-size: 18px !important;
  color: #000000 !important;
}

.muted {
  font-size: 14px;
  color: #6b7280;
  margin-bottom: 16px;
}

.table {
  width: 100%;
  border-collapse: collapse;
}

.table th {
  background: #f3f4f6;
  padding: 10px;
  text-align: left;
}

.table td {
  padding: 10px;
  border-bottom: 1px solid #e5e7eb;
}

.status {
  padding: 4px 10px;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 600;
}

.hadir { background:#dcfce7; color:#166534; }
.izin { background:#fef9c3; color:#854d0e; }
.sakit { background:#fed7aa; color:#9a3412; }
.alpa { background:#fee2e2; color:#991b1b; }

/* 🔥 TAMBAHAN ANIMASI NOTIF */
.alert-success {
  background: #dcfce7;
  padding: 12px;
  border-radius: 8px;
  margin-bottom: 16px;
  color: #166534;
  opacity: 1;
  transition: opacity 0.5s ease;
}

/* 🔥 REKAP */
.rekap-container {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 12px;
  margin-bottom: 20px;
}

.rekap-card {
  padding: 14px;
  border-radius: 12px;
  font-weight: 600;
  text-align: center;
  color: #111827;
}

.rekap-hadir { background:#dcfce7; color:#166534; }
.rekap-izin  { background:#fef9c3; color:#854d0e; }
.rekap-sakit { background:#fed7aa; color:#9a3412; }
.rekap-alpa  { background:#fee2e2; color:#991b1b; }

.rekap-number {
  font-size: 20px;
  font-weight: 800;
  margin-top: 5px;
}
</style>

<div class="card">

  {{-- HEADER --}}
  <div class="card-head" style="display:flex; justify-content:space-between; align-items:center;">
    <div>
      <h2 class="card-title">Data Absensi Siswa</h2>

      {{-- 🔥 UPGRADE UX (KONTEKS TANGGAL) --}}
      <div class="muted">
        Menampilkan absensi tanggal 
        <strong>{{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}</strong>
      </div>

    </div>

    <a href="{{ route('teacher.student_attendance.bulk_create') }}" 
       class="btn btn-outline"
       style="display:flex; align-items:center; gap:6px; font-weight:600;">
      Input Absensi
    </a>
  </div>

  {{-- ✅ NOTIF SUCCESS --}}
  @if(session('success'))
    <div id="successAlert" class="alert-success">
      {{ session('success') }}
    </div>
  @endif

  {{-- 🔍 FILTER --}}
  <form method="GET" style="margin:15px 0; display:flex; gap:10px; align-items:center;">
    <input type="date" name="date" class="input" value="{{ $date }}">
    <button class="btn btn-primary" type="submit">Filter</button>

    <a href="{{ route('teacher.student_attendance.index') }}" 
       class="btn btn-outline">
      Reset
    </a>
  </form>

  {{-- 📊 REKAP --}}
  <div class="rekap-container">

    <div class="rekap-card rekap-hadir">
      HADIR
      <div class="rekap-number">{{ $rekap['hadir'] }}</div>
    </div>

    <div class="rekap-card rekap-izin">
      IZIN
      <div class="rekap-number">{{ $rekap['izin'] }}</div>
    </div>

    <div class="rekap-card rekap-sakit">
      SAKIT
      <div class="rekap-number">{{ $rekap['sakit'] }}</div>
    </div>

    <div class="rekap-card rekap-alpa">
      ALPA
      <div class="rekap-number">{{ $rekap['alpa'] }}</div>
    </div>

  </div>

  {{-- TABLE --}}
  <table class="table">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Catatan</th>
      </tr>
    </thead>

    <tbody>
      @forelse($attendances as $a)
      <tr>

        <td>{{ $a->student->name }}</td>

        <td>{{ $a->date->translatedFormat('d F Y') }}</td>

        <td>
          @if($a->status == 'HADIR')
            <span class="status hadir">HADIR</span>
          @elseif($a->status == 'IZIN')
            <span class="status izin">IZIN</span>
          @elseif($a->status == 'SAKIT')
            <span class="status sakit">SAKIT</span>
          @elseif($a->status == 'ALPA')
            <span class="status alpa">ALPA</span>
          @endif
        </td>

        <td>{{ $a->note ?? '-' }}</td>

      </tr>
      @empty
      <tr>
        <td colspan="4" style="text-align:center; color:#6b7280;">
          {{-- 🔥 UPGRADE UX EMPTY STATE --}}
          Tidak ada data absensi pada tanggal ini
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>

</div>

{{-- 🔥 SCRIPT AUTO HILANG --}}
<script>
  setTimeout(() => {
    let alert = document.getElementById('successAlert');
    if(alert){
      alert.style.opacity = '0';
      setTimeout(() => alert.remove(), 500);
    }
  }, 3000);
</script>

@endsection