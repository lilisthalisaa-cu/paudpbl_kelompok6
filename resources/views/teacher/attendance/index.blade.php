@extends('teacher.layouts.app')

@section('title', 'Data Absensi Guru')

@section('content')

<div class="card">

  {{-- HEADER --}}
  <div class="card-head top-head">
    <div>
      <h2 class="card-title">Data Presensi Guru</h2>
      <div class="muted">Riwayat kehadiran guru</div>
    </div>
  </div>

  {{-- FILTER --}}
  <form method="GET" style="margin:16px 0;">

    <input type="month"
      name="month"
      value="{{ request('month') }}"
      style="
             padding:8px 12px;
             border-radius:8px;
             border:1px solid #e5e7eb;
             font-size:14px;
           ">

    <button type="submit"
      style="
              padding:8px 14px;
              border-radius:8px;
              background:#111827;
              color:white;
              border:none;
              margin-left:6px;
              cursor:pointer;
            ">
      Filter
    </button>

  </form>

  {{-- SUCCESS --}}
  @if(session('success'))

  <div style="
      background:#dcfce7;
      padding:10px;
      border-radius:8px;
      margin-bottom:12px;
      color:#166534;
    ">
    {{ session('success') }}
  </div>

  @endif

  {{-- TABLE --}}
  <div class="attendance-table-wrap">

    <table class="table">

      <thead>

        <tr>

          <th>Tanggal</th>

          <th>Status</th>

          <th>Catatan</th>
          <th>Jam Masuk</th>

          <th>Jam Pulang</th>

        </tr>

      </thead>

      <tbody>

        @forelse($attendances as $a)

        <tr>

          <td>
            {{ \Carbon\Carbon::parse($a->date)->format('d M Y') }}
          </td>

          <td>

            @if($a->status == 'HADIR')

            <span class="badge badge-hadir">
              Hadir
            </span>

            @elseif($a->status == 'IZIN')

            <span class="badge badge-izin">
              Izin
            </span>

            @elseif($a->status == 'SAKIT')

            <span class="badge badge-sakit">
              Sakit
            </span>

            @elseif($a->status == 'CUTI')

            <span class="badge badge-izin">
              Cuti
            </span>

            @else

            <span class="badge badge-alpa">
              Alpa
            </span>

            @endif

          </td>

          <td>
            {{ $a->note ?? '-' }}
          </td>

          <td>
            {{ $a->jam_masuk ?? '-' }}
          </td>

          <td>
            {{ $a->jam_pulang ?? '-' }}
          </td>

        </tr>

        @empty

        <tr>

          <td colspan="5"
            style="
        text-align:center;
        padding:20px;
    ">
            Belum ada data
          </td>

        </tr>

        @endforelse

      </tbody>

    </table>

  </div>

</div>

@endsection