@extends('teacher.layouts.app')

@section('title', 'Absensi Siswa (Bulk)')

@section('content')

<div class="card">

  {{-- 🔥 HEADER + TOMBOL --}}
  <div class="card-head" style="display:flex; justify-content:space-between; align-items:center;">
    <div>
      <h2 class="card-title">Absensi Siswa</h2>
      <div class="muted">Input kehadiran semua siswa</div>
    </div>

    {{-- 🔥 TAMBAHAN (TIDAK MENGUBAH LOGIC) --}}
    <a href="{{ route('teacher.student_attendance.index') }}" 
       class="btn btn-outline"
       style="display:flex; align-items:center; gap:6px; font-weight:600;">
      Lihat Data Absensi
    </a>
  </div>

  @if(session('success'))
    <div class="auth-error">
      {{ session('success') }}
    </div>
  @endif

  {{-- 🔥 FORM BULK --}}
  <form method="POST" action="{{ route('teacher.student_attendance.bulk_store') }}">
    @csrf

    {{-- TANGGAL --}}
    <div class="field">
      <label class="label">Tanggal</label>
      <input type="date" name="date" class="input" value="{{ date('Y-m-d') }}" required>
    </div>

    {{-- TABLE --}}
    <table style="width:100%; border-collapse: collapse;">
      <thead>
        <tr style="background:#f3f4f6;">
          <th style="padding:10px;">No</th>
          <th>Nama Siswa</th>
          <th>Status</th>
          <th>Catatan</th>
        </tr>
      </thead>

      <tbody>
        @foreach($students as $index => $student)
        <tr style="border-bottom:1px solid #e5e7eb;">
          
          <td style="padding:10px;">{{ $index+1 }}</td>

          <td>
            {{ $student->name }}
          </td>

          <td>
            <select name="attendances[{{ $student->id }}][status]" class="input">
              <option value="">-</option>
              <option value="HADIR">Hadir</option>
              <option value="IZIN">Izin</option>
              <option value="SAKIT">Sakit</option>
              <option value="ALPA">Alpa</option>
            </select>
          </td>

          <td>
            <input type="text" 
                   name="attendances[{{ $student->id }}][note]" 
                   class="input" 
                   placeholder="Catatan">
          </td>

        </tr>
        @endforeach
      </tbody>
    </table>

    {{-- BUTTON --}}
    <div style="margin-top:20px;">
      <button type="submit" class="btn btn-primary">Simpan Semua</button>
    </div>

  </form>

</div>

@endsection