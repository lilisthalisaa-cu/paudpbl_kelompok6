@extends('layouts.app')

@section('title','Absensi Guru')

@section('content')

<div class="container mt-4">

  <h2>Absensi Guru</h2>
  <p>Silakan lakukan absensi hari ini</p>

  <form action="#" method="POST">
    @csrf

    {{-- TANGGAL --}}
    <div class="mb-3">
      <label>Tanggal</label>
      <input type="date" class="form-control" name="tanggal" required>
    </div>

    {{-- STATUS --}}
    <div class="mb-3">
      <label>Status Kehadiran</label>
      <select class="form-control" name="status" required>
        <option value="">-- Pilih Status --</option>
        <option value="hadir">Hadir</option>
        <option value="izin">Izin</option>
        <option value="sakit">Sakit</option>
      </select>
    </div>

    {{-- KETERANGAN --}}
    <div class="mb-3">
      <label>Keterangan (Opsional)</label>
      <textarea 
        class="form-control" 
        name="keterangan" 
        rows="3"
        placeholder="Contoh: Izin karena keperluan keluarga..."
      ></textarea>
    </div>

    <button type="submit" class="btn btn-primary">
      Simpan Absensi
    </button>

  </form>

</div>

@endsection