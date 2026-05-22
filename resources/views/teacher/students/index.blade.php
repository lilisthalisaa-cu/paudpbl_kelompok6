@extends('teacher.layouts.app')

@section('title','Data Siswa')

@section('content')

<div class="card">

  {{-- HEADER --}}
  <div class="card-head"
       style="display:flex; justify-content:space-between; align-items:center;">

    <div>

      <h2 class="card-title">
        Data Siswa
      </h2>

      <div class="muted">
        Daftar siswa sesuai kelas Anda
      </div>

    </div>

  </div>

  <style>

    .student-table{
      width:100%;
      border-collapse:collapse;
      margin-top:20px;
    }

    .student-table th{
      background:#f3f4f6;
      padding:16px 14px;
      text-align:left;
      font-weight:700;
      font-size:15px;
      color:#111827;
    }

    .student-table td{
      padding:16px 14px;
      border-bottom:1px solid #e5e7eb;
      font-size:15px;
      color:#111827;
      vertical-align:middle;
    }

    .student-table tbody tr:nth-child(even){
      background:#f9fafb;
    }

    .student-table tbody tr:hover{
      background:#f3f4f6;
    }

    .gender-badge{
      font-size:15px;
      font-weight:400;
      color:#111827;
    }

    .empty-row{
      text-align:center;
      color:#6b7280;
      padding:30px !important;
    }

  </style>

  <table class="student-table">

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

        <td>
          {{ $s->name }}
        </td>

        <td>
          {{ $s->nisn ?: 'Belum diisi' }}
        </td>

        <td>

          @if($s->gender)

            <span class="gender-badge">
              {{ $s->gender }}
            </span>

          @else

            <span style="
              color:#9ca3af;
              font-style:italic;
            ">
              Belum diisi
            </span>

          @endif

        </td>

        <td>
          {{ $s->schoolClass->name ?? 'Belum diisi' }}
        </td>

        <td>
          {{ $s->parent_name ?: 'Belum diisi' }}
        </td>

        <td>
          {{ $s->parent_phone ?: 'Belum diisi' }}
        </td>

      </tr>

      @empty

      <tr>

        <td colspan="6"
            class="empty-row">

          Tidak ada data siswa

        </td>

      </tr>

      @endforelse

    </tbody>

  </table>

</div>

@endsection