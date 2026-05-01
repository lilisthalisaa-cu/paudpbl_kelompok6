@extends('teacher.layouts.app')

@section('title','Data Siswa')

@section('content')

<div class="card">

  {{-- HEADER --}}
  <div class="card-head" style="display:flex; justify-content:space-between; align-items:center;">
    <div>
      <h2 class="card-title">Data Siswa</h2>
      <div class="muted">Daftar siswa sesuai kelas Anda</div>
    </div>
  </div>

  <style>
    .table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
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

    /* 🔥 zebra biar kayak sistem kamu */
    .table tbody tr:nth-child(even) {
      background: #f9fafb;
    }
  </style>

  <table class="table">
    <thead>
      <tr>
        <th>Nama</th>
        <th>NISN</th>
        <th>Jenis Kelamin</th>
        <th>Kelas</th>
        <th>Orang Tua</th>
        <th>No HP</th>
      </tr>
    </thead>

    <tbody>
      @forelse($students as $s)
      <tr>
        <td>{{ $s->name }}</td>
        <td>{{ $s->nisn }}</td>
        <td>{{ $s->gender }}</td>
        <td>{{ $s->schoolClass->name ?? '-' }}</td>
        <td>{{ $s->parent_name }}</td>
        <td>{{ $s->parent_phone }}</td>
      </tr>
      @empty
      <tr>
        <td colspan="6" style="text-align:center; color:#6b7280;">
          Tidak ada data siswa
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>

</div>

@endsection