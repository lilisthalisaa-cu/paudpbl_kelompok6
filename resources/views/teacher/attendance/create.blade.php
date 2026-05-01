@extends('teacher.layouts.app')

@section('title', 'Input Absensi Guru')

@section('content')

<style>

input, select, textarea {
  font-family: 'Inter', system-ui, -apple-system, sans-serif;
  font-size: 14px;
  color: #111827;
}

input, select, textarea {
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
}

.card-title {
  font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif !important;
  font-weight: 800 !important; /* 🔥 lebih gemuk */
  font-size: 18px !important;  /* 🔥 sedikit lebih kecil */
  letter-spacing: 0px !important;
  color: #000000 !important;
}

.muted {
  font-size: 14px;
  color: #6b7280;
  margin-bottom: 16px;
}

.field {
  margin-bottom: 16px;
}

.label {
  font-weight: 600;
  margin-bottom: 6px;
  display: block;
  color: #374151;
}

.input {
  width: 100%;
  padding: 12px 14px;
  border-radius: 12px;
  border: 1px solid #e5e7eb;
  background: #fff;
  transition: 0.2s;
}

.input:focus {
  border-color: #2563eb;
  outline: none;
  box-shadow: 0 0 0 2px rgba(37,99,235,0.1);
}

select.input {
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='%236b7280' d='M5 7l5 5 5-5z'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: right 12px center;
  background-size: 14px;
  padding-right: 36px;
}

textarea.input {
  resize: none;
  line-height: 1.5;
}

input[type="date"] {
  font-family: inherit;
}

.btn-primary {
  padding: 10px 18px;
  border-radius: 999px;
  font-weight: 600;
}

.auth-error {
  background: #dcfce7;
  padding: 10px;
  border-radius: 8px;
  margin-bottom: 12px;
  color: #166534;
}

.top-head {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.btn-outline:hover {
  background: #f9fafb;
}
</style>

<div class="card">

  <div class="card-head top-head">
    <div>
      <h2 class="card-title">Input Absensi Guru</h2>
      <div class="muted">Isi kehadiran guru untuk hari ini.</div>
    </div>

    <a href="{{ route('teacher.attendance.index') }}" class="btn btn-outline" style="
      display:flex;
      align-items:center;
      gap:6px;
      font-weight:700;
    ">
      Lihat Data Absensi
    </a>
  </div>

  @if(session('success'))
    <div class="auth-error">
      {{ session('success') }}
    </div>
  @endif

  @if ($errors->any())
    <div style="background:#fee2e2;padding:10px;border-radius:8px;margin-bottom:12px;color:#991b1b;">
      {{ $errors->first() }}
    </div>
  @endif

  <form method="POST" action="{{ route('teacher.attendance.store') }}" class="auth-form">
    @csrf

    {{-- TANGGAL --}}
    <div class="field">
      <label class="label">Tanggal</label>
      <input type="date" name="date" class="input" value="{{ old('date', date('Y-m-d')) }}" required>
    </div>

    {{-- STATUS --}}
    <div class="field">
      <label class="label">Status</label>
      <select name="status" class="input" required>
        <option value="">Pilih Status</option>
        <option value="HADIR">Hadir</option>
        <option value="TIDAK_HADIR">Tidak Hadir</option>
      </select>
    </div>

    {{-- CATATAN --}}
    <div class="field">
      <label class="label">Catatan</label>
      <textarea name="note" class="input" placeholder="Catatan tambahan">{{ old('note') }}</textarea>
    </div>

    <div class="auth-footer">
      <div></div>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </form>
</div>

@endsection