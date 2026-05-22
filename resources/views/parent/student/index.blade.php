@extends('parent.layouts.app')

@section('title', 'Informasi Anak')

@section('content')

<div class="container">

  <!-- HEADER -->
  <div class="page-header">

    Informasi Anak 👶

    <div style="
      font-size:14px;
      font-weight:400;
      margin-top:4px;
    ">

      Data lengkap anak Anda

    </div>

  </div>

  <!-- CARD -->
  <div class="card">

    @if($student)

      <!-- FOTO -->
      <div style="
        text-align:center;
        margin-bottom:24px;
      ">

        <div style="
          width:120px;
          height:120px;
          border-radius:50%;
          background:#f3f4f6;
          display:flex;
          align-items:center;
          justify-content:center;
          font-size:48px;
          color:#9ca3af;
          margin:auto;
          box-shadow:0 6px 18px rgba(0,0,0,.06);
        ">

          👤

        </div>

      </div>

      <!-- JUDUL -->
      <h3 style="
        text-align:center;
        font-weight:800;
        margin-bottom:36px;
        font-size:28px;
        color:#1f2937;
        letter-spacing:.4px;
      ">

        PROFIL SISWA

      </h3>

      <!-- BIODATA -->
      <table class="bio-table" style="
        width:100%;
        max-width:780px;
        margin:auto;
      ">

        <tr>

          <td class="label">
            Nama
          </td>

          <td class="value">
            {{ $student->name ?: 'Belum diisi' }}
          </td>

        </tr>

        <tr>

          <td class="label">
            NISN
          </td>

          <td class="value">
            {{ $student->nisn ?: 'Belum diisi' }}
          </td>

        </tr>

        <tr>

          <td class="label">
            Kelas
          </td>

          <td class="value">
            {{ $student?->schoolClass?->name ?: 'Belum diisi' }}
          </td>

        </tr>

        <tr>

          <td class="label">
            Jenis Kelamin
          </td>

          <td class="value">

            @if($student->gender)

              {{ $student->gender }}

            @else

              <span style="
                color:#9ca3af;
                font-style:italic;
              ">
                Belum diisi
              </span>

            @endif

          </td>

        </tr>

        <tr>

          <td class="label">
            Nama Orang Tua
          </td>

          <td class="value">
            {{ $student->parent_name ?: 'Belum diisi' }}
          </td>

        </tr>

        <tr>

          <td class="label">
            Telepon Orang Tua
          </td>

          <td class="value">

            @if($student->parent_phone)

              {{ $student->parent_phone }}

            @else

              <span style="
                color:#9ca3af;
                font-style:italic;
              ">
                Belum diisi
              </span>

            @endif

          </td>

        </tr>

        <tr>

          <td class="label">
            Alamat
          </td>

          <td class="value">
            {{ $student->address ?: 'Belum diisi' }}
          </td>

        </tr>

      </table>

    @else

      <div style="
        text-align:center;
        padding:40px;
        color:#6b7280;
        font-size:14px;
      ">

        Data siswa belum tersedia

      </div>

    @endif

  </div>

</div>

@endsection