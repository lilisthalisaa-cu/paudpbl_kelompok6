@extends('parent.layouts.app')

@section('title', 'Absensi Anak')

@section('content')

<div class="parent-dashboard">

  <!-- HERO -->
  <div class="parent-hero">
    <h2>Absensi Bulanan 📅</h2>
  </div>

  <!-- CARD -->
  <div class="card parent-card">

    <!-- FILTER -->
    <form method="GET" style="margin-bottom:15px; display:flex; gap:10px; align-items:center;">
      <input type="month" name="month" value="{{ $month ?? '' }}">
      <button type="submit" class="btn-orange">Filter</button>
    </form>

    @if(isset($attendances) && $attendances->count() > 0)

      <table class="table" style="width:100%; border-collapse:collapse;">
        <thead>
          <tr>
            <th style="text-align:left; padding:10px;">Tanggal</th>
            <th style="text-align:left; padding:10px;">Status</th>
          </tr>
        </thead>

        <tbody>
          @foreach($attendances as $a)

          @php
            $statusClass =
              $a->status == 'HADIR' ? 'status-hadir' :
              ($a->status == 'IZIN' ? 'status-izin' : 'status-alpha');
          @endphp

          <tr>
            <td style="padding:10px;">
              {{ \Carbon\Carbon::parse($a->date)->format('d M Y') }}
            </td>

            <td style="padding:10px;">
              <span class="status-badge {{ $statusClass }}">
                {{ $a->status }}
              </span>
            </td>
          </tr>

          @endforeach
        </tbody>
      </table>

    @else

      <div class="parent-empty" style="text-align:center; padding:30px; color:#6b7280;">
        Belum ada data absensi
      </div>

    @endif

  </div>

</div>

@endsection