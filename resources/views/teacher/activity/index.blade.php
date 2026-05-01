@extends('teacher.layouts.app')

@section('title','Data Kegiatan')

@section('content')

<div class="card">

  <h2>Data Kegiatan Siswa</h2>

  @if(session('success'))
    <div style="background:#d1fae5;padding:10px;border-radius:8px;margin-bottom:12px;">
      {{ session('success') }}
    </div>
  @endif

  {{-- 🔥 STYLE --}}
  <style>
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

    /* 🔥 ZEBRA */
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

    .check {
      font-size: 18px;
      font-weight: bold;
    }

    .yes {
      color: green;
    }

    .no {
      color: red;
    }

    .desc-text {
      font-size: inherit;
      color: inherit;
      font-family: inherit;
    }
  </style>

  {{-- 🔥 TABLE FIX --}}
  <table class="table">
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>Siswa</th>
        <th>Kegiatan</th>
        <th>Keterangan</th>
        <th>Foto</th>
      </tr>
    </thead>

    <tbody>
      @foreach($activities as $a)
      <tr>
        <td>{{ \Carbon\Carbon::parse($a->date)->translatedFormat('d M Y') }}</td>
        <td>{{ $a->student->name }}</td>

        <td>{{ $a->title }}</td>

        <td style="text-align:center;">
          
          @if($a->status == 'SM')
            <div class="check yes">✔ SM</div>
          @elseif($a->status == 'BM')
            <div class="check no">✔ BM</div>
          @endif

          <div class="desc-text" style="margin-top:4px;">
            {{ $a->description ?? '-' }}
          </div>

        </td>

        <td style="text-align:center;">
          @if($a->photo)
            <img src="{{ asset('storage/'.$a->photo) }}" style="width:220px; border-radius:10px;">
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>

  </table>

</div>

@endsection