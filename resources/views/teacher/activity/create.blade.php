@extends('teacher.layouts.app')

@section('title', 'Input Kegiatan Siswa')

@section('content')

<style>
input, textarea, select {
  font-family: inherit;
}

input[type="date"] {
  font-family: inherit;
  font-size: 14px;
}

::placeholder {
  font-family: inherit;
  font-size: 14px;
  color: #9ca3af;
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
  <div class="card-head">
    <div>
      <h2 class="card-title">Input Kegiatan Siswa</h2>
      <div class="muted">Isi kegiatan harian siswa.</div>
    </div>

    {{-- 🔥 TAMBAHAN (TIDAK MENGUBAH YANG LAIN) --}}
    <a href="{{ route('teacher.activity.index') }}" class="btn btn-outline" style="
      display:flex;
      align-items:center;
      gap:6px;
      font-weight:600;
    ">
      Lihat Data Kegiatan
    </a>

  </div>

  @if(session('success'))
    <div class="auth-error" style="color:green;">{{ session('success') }}</div>
  @endif

  <form method="POST" action="{{ route('teacher.activity.store') }}" class="auth-form" enctype="multipart/form-data">
    @csrf

    <div class="field">
      <label class="label">Tanggal</label>
      <input type="date" name="date" class="input" value="{{ date('Y-m-d') }}" required>
    </div>

    <div class="field">
      <label class="label">Siswa</label>
      <select name="student_id" class="input" required>
        <option value="">Pilih Siswa</option>
        @foreach($students as $student)
          <option value="{{ $student->id }}">{{ $student->name }} - {{ $student->nisn }}</option>
        @endforeach
      </select>
    </div>

    <div class="field">
      <label class="label">Judul Kegiatan</label>
      <input type="text" name="title" class="input" required placeholder="Contoh: Belajar mewarnai">
    </div>

    <div class="field">
      <label class="label">Deskripsi</label>
      <textarea name="description" class="input" placeholder="Keterangan kegiatan"></textarea>
    </div>

    <div class="field">
      <label class="label">Foto Kegiatan</label>
      <input type="file" name="photo" class="input" accept="image/*">
    </div>

    <div class="auth-footer">
      <div></div>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </form>
</div>

@endsection