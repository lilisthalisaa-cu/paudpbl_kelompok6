@extends('layouts.app')

@section('title','Kegiatan Harian')

@section('content')

<div class="container mt-4">

  <h2>Input Kegiatan Harian Siswa</h2>
  <p>Catat aktivitas dan dokumentasi siswa hari ini</p>

  <form action="#" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- TANGGAL --}}
    <div class="mb-3">
      <label>Tanggal</label>
      <input type="date" class="form-control" name="tanggal" required>
    </div>

    {{-- PILIH SISWA --}}
    <div class="mb-3">
      <label>Nama Siswa</label>
      <select class="form-control" name="student_id" required>
        <option value="">-- Pilih Siswa --</option>
        <option value="1">Budi</option>
        <option value="2">Siti</option>
      </select>
    </div>

    {{-- DESKRIPSI --}}
    <div class="mb-3">
      <label>Deskripsi Kegiatan</label>
      <textarea 
        class="form-control" 
        name="deskripsi" 
        rows="4"
        placeholder="Contoh: Hari ini siswa belajar mengenal huruf A, bermain balok, dan menggambar..."
        required>
      </textarea>
    </div>

    {{-- FOTO --}}
    <div class="mb-3">
      <label>Upload Foto Kegiatan</label>
      <input 
        type="file" 
        class="form-control" 
        name="foto"
        accept="image/*">
    </div>

    {{-- SUBMIT --}}
    <button type="submit" class="btn btn-primary">
      Simpan Kegiatan
    </button>

  </form>

</div>

@endsection