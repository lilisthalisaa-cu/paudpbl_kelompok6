@extends('parent.layouts.app')

@section('title', 'Informasi Anak')

@section('content')

<div class="container">

  <!-- HEADER -->
  <div class="page-header">
    Informasi Anak 👶
    <div style="font-size:14px; font-weight:400; margin-top:4px;">
      Data lengkap anak Anda
    </div>
  </div>

  <!-- CARD -->
  <div class="card">

    <!-- FOTO -->
    <div style="text-align:center; margin-bottom:20px;">
      <div style="
        width:110px;
        height:110px;
        border-radius:50%;
        background:#e5e7eb;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:42px;
        color:#9ca3af;
        margin:auto;
      ">
        👤
      </div>
    </div>

    <!-- JUDUL -->
    <h3 style="
      text-align:center;
      font-weight:800;
      margin-bottom:30px;
      font-size:22px;
    ">
      PROFIL SISWA
    </h3>

    <!-- BIODATA -->
    <table class="bio-table">

      <tr>
        <td class="label">Nama</td>
        <td class="value">{{ $student->name ?? '-' }}</td>
      </tr>

      <tr>
        <td class="label">NISN</td>
        <td class="value">{{ $student->nisn ?? '-' }}</td>
      </tr>

      <tr>
        <td class="label">Kelas</td>
        <td class="value">{{ optional($student->schoolClass)->name ?? '-' }}</td>
      </tr>

      <tr>
        <td class="label">Jenis Kelamin</td>
        <td class="value">{{ $student->gender ?? 'Laki-laki' }}</td>
      </tr>

      <tr>
        <td class="label">Alamat</td>
        <td class="value">{{ $student->address ?? '-' }}</td>
      </tr>

    </table>

  </div>

</div>

@endsection