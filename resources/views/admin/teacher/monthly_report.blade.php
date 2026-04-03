@extends('layouts.app')

@section('title','Perkembangan Bulanan')

@section('content')

<div class="container mt-4">

  <h2>Input Perkembangan Bulanan Siswa</h2>
  <p>Isi laporan perkembangan siswa setiap bulan</p>

  <form action="#" method="POST">
    @csrf

    {{-- PILIH SISWA --}}
    <div class="mb-3">
      <label>Nama Siswa</label>
      <select class="form-control" name="student_id" required>
        <option value="">-- Pilih Siswa --</option>
        <option value="1">Budi</option>
        <option value="2">Siti</option>
      </select>
    </div>

    {{-- BULAN --}}
    <div class="mb-3">
      <label>Bulan</label>
      <input type="month" class="form-control" name="bulan" required>
    </div>

    {{-- ASPEK PENILAIAN --}}
    <div class="mb-3">
      <label>Perkembangan Motorik</label>
      <select class="form-control" name="motorik">
        <option>Baik</option>
        <option>Cukup</option>
        <option>Perlu Bimbingan</option>
      </select>
    </div>

    <div class="mb-3">
      <label>Perkembangan Kognitif</label>
      <select class="form-control" name="kognitif">
        <option>Baik</option>
        <option>Cukup</option>
        <option>Perlu Bimbingan</option>
      </select>
    </div>

    <div class="mb-3">
      <label>Perkembangan Sosial</label>
      <select class="form-control" name="sosial">
        <option>Baik</option>
        <option>Cukup</option>
        <option>Perlu Bimbingan</option>
      </select>
    </div>

    {{-- CATATAN --}}
    <div class="mb-3">
      <label>Catatan Guru</label>
      <textarea 
        class="form-control" 
        name="catatan" 
        rows="4"
        placeholder="Tambahkan catatan perkembangan siswa..."
      ></textarea>
    </div>

    <button type="submit" class="btn btn-primary">
      Simpan Laporan
    </button>

  </form>

</div>

@endsection