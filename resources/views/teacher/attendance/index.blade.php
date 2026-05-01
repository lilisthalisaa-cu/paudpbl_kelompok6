@extends('teacher.layouts.app')

@section('title', 'Data Absensi Guru')

@section('content')

<style>
.card-title {
  font-size: 20px;
  font-weight: 700;
}

.muted {
  font-size: 14px;
  color: #6b7280;
  margin-bottom: 16px;
}

.top-head {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.filter-bar {
  display: flex;
  gap: 8px;
  margin: 16px 0;
  flex-wrap: wrap;
}

.filter-btn {
  padding: 6px 14px;
  border-radius: 999px;
  border: 1px solid #e5e7eb;
  text-decoration: none;
  font-size: 13px;
  font-weight: 500;
  background: #fff;
  color: #374151;
}

.filter-btn:hover {
  background: #f9fafb;
}

.badge {
  padding: 4px 10px;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 600;
}

.badge-hadir { background:#dcfce7; color:#166534; }
.badge-izin { background:#fef9c3; color:#854d0e; }
.badge-sakit { background:#ffedd5; color:#9a3412; }
.badge-alpa { background:#fee2e2; color:#991b1b; }

.table {
  width: 100%;
  border-collapse: collapse;
}

.table th {
  text-align: left;
  font-size: 13px;
  color: #6b7280;
  padding: 10px 0;
}

.table td {
  padding: 12px 0;
  border-top: 1px solid #f3f4f6;
}
</style>

<div class="card">

  {{-- HEADER --}}
  <div class="card-head top-head">
    <div>
      <h2 class="card-title">Data Absensi Guru</h2>
      <div class="muted">Riwayat kehadiran guru</div>
    </div>

    <a href="{{ route('teacher.attendance.create') }}" class="btn btn-primary">
      + Tambah
    </a>
  </div>

  {{-- FILTER --}}
  <form method="GET" style="margin:16px 0;">
  <input type="month" name="month" value="{{ request('month') }}"
    style="
      padding:8px 12px;
      border-radius:8px;
      border:1px solid #e5e7eb;
      font-size:14px;
    ">

  <button type="submit" style="
    padding:8px 14px;
    border-radius:8px;
    background:#111827;
    color:white;
    border:none;
    margin-left:6px;
    cursor:pointer;
  ">
    Filter
  </button>
</form>

  {{-- SUCCESS --}}
  @if(session('success'))
    <div style="background:#dcfce7;padding:10px;border-radius:8px;margin-bottom:12px;color:#166534;">
      {{ session('success') }}
    </div>
  @endif

  {{-- TABLE --}}
  <table class="table">
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Catatan</th>
      </tr>
    </thead>
    <tbody>
      @forelse($attendances as $a)
        <tr>
          <td>{{ \Carbon\Carbon::parse($a->date)->format('d M Y') }}</td>

          <td>
            @if($a->status == 'HADIR')
              <span class="badge badge-hadir">Hadir</span>
            @elseif($a->status == 'IZIN')
              <span class="badge badge-izin">Izin</span>
            @elseif($a->status == 'SAKIT')
              <span class="badge badge-sakit">Sakit</span>
            @else
              <span class="badge badge-alpa">Alpa</span>
            @endif
          </td>

          <td>{{ $a->note ?? '-' }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="3" style="text-align:center; padding:20px;">
            Belum ada data
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>

</div>

@endsection