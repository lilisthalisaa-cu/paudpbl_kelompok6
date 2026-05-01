@extends('teacher.layouts.app')

@section('title','Perkembangan Anak')

@section('content')

<div class="card">

  <h2 class="card-title">Data Perkembangan Anak</h2>
  <div class="muted">Daftar perkembangan siswa per bulan</div>

  @if(session('success'))
    <div style="color:green">{{ session('success') }}</div>
  @endif

  {{-- FILTER --}}
  <form method="GET" style="margin-bottom:20px;">
    <select name="student_id">
      <option value="">-- Semua Siswa --</option>
      @foreach($students as $s)
        <option value="{{ $s->id }}" {{ request('student_id') == $s->id ? 'selected' : '' }}>
          {{ $s->name }}
        </option>
      @endforeach
    </select>

    <input type="month" name="month" value="{{ request('month') }}">

    <button type="submit">Filter</button>
  </form>

  {{-- 🔥 STYLE (TAMBAHAN AJA, TIDAK MERUBAH LOGIC) --}}
  <style>
    .card-title {
      font-weight: 800;
      font-size: 18px;
      color: #000;
    }

    .muted {
      font-size: 14px;
      color: #6b7280;
      margin-bottom: 16px;
    }

    .table {
      width: 100%;
      border-collapse: collapse;
    }

    .table th {
      background: #e5e7eb;
      padding: 10px;
      text-align: left;
      font-weight: 700;
    }

    .table td {
      padding: 10px;
      border-bottom: 1px solid #e5e7eb;
    }

    /* 🔥 BELANG */
    .table tbody tr:nth-child(odd) td {
      background-color: #f9fafb;
    }

    .table tbody tr:nth-child(even) td {
      background-color: #ffffff;
    }

    /* 🔥 HOVER */
    .table tbody tr:hover td {
      background-color: #e0f2fe;
      transition: 0.2s;
    }
  </style>

  {{-- 🔥 TABLE --}}
  <table class="table">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Bulan</th>
        <th>Tahun</th>
        <th>TB (cm)</th>
        <th>BB (kg)</th>
        <th>Catatan</th>
        <th>Aksi</th> 
      </tr>
    </thead>

    <tbody>
      @forelse($data as $d)
        <tr>
          <td>{{ $d->student->name }}</td>

          <td>
            {{
              [
                1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',
                5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',
                9=>'September',10=>'Oktober',11=>'November',12=>'Desember'
              ][ (int) (is_string($d->month) ? substr($d->month, -2) : $d->month) ] ?? $d->month
            }}
          </td>

          <td>{{ $d->year }}</td>

          <td>{{ $d->tb ?? '-' }}</td>
          <td>{{ $d->bb ?? '-' }}</td>

          <td>{{ $d->description }}</td>

          <td style="text-align:center;">
            <a href="{{ route('teacher.development.edit', $d->id) }}" style="
              display:inline-block;
              padding:6px 14px;
              border-radius:999px;
              background:#ffffff;
              border:1px solid #e5e7eb;
              font-size:13px;
              font-weight:600;
              color:#111827;
              text-decoration:none;
              transition:0.2s;
              "
              onmouseover="this.style.background='#f9fafb'"
              onmouseout="this.style.background='#ffffff'">
                Edit
            </a>
          </td>

        </tr>
      @empty
        <tr>
          <td colspan="7" align="center" style="color:#6b7280;">
            Belum ada data
          </td> 
        </tr>
      @endforelse
    </tbody>
  </table>

</div>

@endsection