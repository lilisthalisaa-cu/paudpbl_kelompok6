@extends('parent.layouts.app')

@section('title', 'Perkembangan Anak')

@section('content')

<div class="parent-dashboard">

  <!-- HERO -->
  <div class="page-header">
    Perkembangan Anak 📈
    <div style="font-size:14px; font-weight:400; margin-top:4px;">
      Catatan perkembangan anak dari guru
    </div>
  </div>

  <!-- CARD -->
  <div class="card parent-card">

    <!-- FILTER -->
    <form method="GET" style="margin-bottom:15px; display:flex; gap:12px; align-items:center;">

      <div style="font-size:13px; color:#6b7280;">
        📅 Pilih Bulan
      </div>

      <input 
        type="month" 
        name="month" 
        value="{{ $month ?? '' }}"
        style="
          padding:8px 12px;
          border:1px solid #e5e7eb;
          border-radius:8px;
          font-size:14px;
        "
      >

      <button type="submit" class="btn-orange">
        Filter
      </button>

    </form>

    <!-- 🔥 INFO BULAN -->
    @if($month)
      <div style="font-size:13px; color:#6b7280; margin-bottom:12px;">
        Menampilkan data bulan 
        <strong>
          {{ \Carbon\Carbon::parse($month)->translatedFormat('F Y') }}
        </strong>
      </div>
    @endif

    @if(isset($developments) && $developments->count() > 0)

      <table class="table">
        <thead>
          <tr>
            <th>Bulan</th>
            <th>Catatan</th>
            <th>TB</th>
            <th>BB</th>
          </tr>
        </thead>
        <tbody>

          @foreach($developments as $d)
          <tr>

            <!-- BULAN -->
            <td>
              {{ \Carbon\Carbon::create($d->year, $d->month)->translatedFormat('F Y') }}
            </td>

            <!-- CATATAN -->
            <td>{{ $d->description }}</td>

            <!-- TB -->
            <td>
              @if($d->tb)
                <span class="badge">{{ $d->tb }} cm</span>
              @else
                -
              @endif
            </td>

            <!-- BB -->
            <td>
              @if($d->bb)
                <span class="badge">{{ $d->bb }} kg</span>
              @else
                -
              @endif
            </td>

          </tr>
          @endforeach

        </tbody>
      </table>

    @else

      <div class="parent-empty" style="text-align:center; padding:30px; color:#6b7280;">
        Belum ada data perkembangan 👶
      </div>

    @endif

  </div>

</div>

@endsection