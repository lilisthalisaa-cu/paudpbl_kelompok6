@extends('layouts.app')

@section('title','Absensi Siswa')

@section('content')

<div class="container mt-4">

  <h2>Input Absensi Siswa</h2>
  <p>Silakan isi kehadiran siswa hari ini</p>

  {{-- FORM --}}
  <form action="#" method="POST">
    @csrf

    <table class="table">
      <thead>
        <tr>
          <th>Nama Siswa</th>
          <th>Kelas</th>
          <th>Status Kehadiran</th>
        </tr>
      </thead>
      <tbody>

        {{-- DATA DUMMY --}}
        <tr>
          <td>Budi</td>
          <td>A</td>
          <td>
            <select name="status[]" class="form-control">
              <option value="hadir">Hadir</option>
              <option value="izin">Izin</option>
              <option value="alpha">Alpha</option>
            </select>
          </td>
        </tr>

        <tr>
          <td>Siti</td>
          <td>A</td>
          <td>
            <select name="status[]" class="form-control">
              <option value="hadir">Hadir</option>
              <option value="izin">Izin</option>
              <option value="alpha">Alpha</option>
            </select>
          </td>
        </tr>

      </tbody>
    </table>

    <button type="submit" class="btn btn-primary">
      Simpan Absensi
    </button>

  </form>

</div>

@endsection