@extends('teacher.layouts.app')
@section('title','Tambah Perkembangan Anak')

@section('content')

<style>
/* 🔥 GLOBAL FONT */
body, input, select, textarea, button {
  font-family: 'Inter', system-ui, -apple-system, sans-serif;
  font-size: 14px;
  color: #111827;
}

/* 🔥 RESET */
input, select, textarea {
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
}

/* 🔥 GRID */
.form-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
}

.full {
  grid-column: span 2;
}

/* 🔥 LABEL */
.label {
  font-weight: 600;
  margin-bottom: 6px;
  display: block;
  color: #374151;
}

/* 🔥 INPUT */
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

/* 🔥 SELECT ICON */
select.input {
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='%236b7280' d='M5 7l5 5 5-5z'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: right 12px center;
  background-size: 14px;
  padding-right: 36px;
}

/* 🔥 TEXTAREA */
textarea.input {
  resize: none;
  line-height: 1.5;
}

/* 🔥 TEXT */
.muted {
  font-size: 14px;
  color: #6b7280;
}

/* 🔥 BUTTON */
.btn-primary {
  padding: 10px 18px;
  border-radius: 999px;
  font-weight: 600;
}

/* 🔥 ERROR */
.error-box {
  background: #fee2e2;
  padding: 10px;
  border-radius: 8px;
  margin-bottom: 12px;
  color: #991b1b;
}

.card-title {
  font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif !important;
  font-weight: 800 !important; /* 🔥 lebih gemuk */
  font-size: 18px !important;  /* 🔥 sedikit lebih kecil */
  letter-spacing: 0px !important;
  color: #000000 !important;
}
</style>

<div class="card">

  {{-- HEADER --}}
  <div class="toolbar">
    <div>
      <h2 class="card-title">Tambah Perkembangan Anak</h2>
      <div class="muted">Isi laporan perkembangan siswa setiap bulan</div>
    </div>

    <a href="{{ route('teacher.development.index') }}" class="btn btn-outline" style="
      display:flex;
      align-items:center;
      gap:6px;
      font-weight:600;
      ">
         Lihat Data Perkembangan
    </a>
  </div>

  {{-- ERROR --}}
  @if ($errors->any())
    <div class="error-box">
      {{ $errors->first() }}
    </div>
  @endif

  {{-- FORM --}}
  <form method="POST" action="{{ route('teacher.development.store') }}">
    @csrf

    <div class="form-grid">

      {{-- SISWA --}}
      <div class="full">
        <label class="label">Nama Siswa</label>
        <select name="student_id" class="input" required>
          <option value="">-- Pilih Siswa --</option>
          @foreach($students as $s)
            <option value="{{ $s->id }}">{{ $s->name }}</option>
          @endforeach
        </select>
      </div>

      {{-- BULAN --}}
      <div>
        <label class="label">Bulan</label>
        <select name="month" class="input" required>
          <option value="">Pilih Bulan</option>
          <option value="1">Januari</option>
          <option value="2">Februari</option>
          <option value="3">Maret</option>
          <option value="4">April</option>
          <option value="5">Mei</option>
          <option value="6">Juni</option>
          <option value="7">Juli</option>
          <option value="8">Agustus</option>
          <option value="9">September</option>
          <option value="10">Oktober</option>
          <option value="11">November</option>
          <option value="12">Desember</option>
        </select>
      </div>

      {{-- TAHUN --}}
      <div>
        <label class="label">Tahun</label>
        <input type="number" name="year" class="input" value="{{ date('Y') }}" required>
      </div>

      {{-- 🔥 TAMBAHAN TB --}}
      <div>
        <label class="label">Tinggi Badan (cm)</label>
        <input type="number" name="tb" class="input" value="{{ old('tb') }}">
      </div>

      {{-- 🔥 TAMBAHAN BB --}}
      <div>
        <label class="label">Berat Badan (kg)</label>
        <input type="number" name="bb" class="input" value="{{ old('bb') }}">
      </div>

      {{-- CATATAN --}}
      <div class="full">
        <label class="label">Catatan</label>
        <textarea name="description" rows="4" class="input" required></textarea>
      </div>

    </div>

    {{-- BUTTON --}}
    <div style="margin-top:16px; display:flex; justify-content:flex-end;">
      <button class="btn btn-primary">Simpan</button>
    </div>

  </form>

</div>

@endsection