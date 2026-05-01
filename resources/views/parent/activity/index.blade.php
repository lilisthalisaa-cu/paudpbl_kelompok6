@extends('parent.layouts.app')

@section('title', 'Kegiatan Harian')

@section('content')

<div class="container">

  <!-- HEADER -->
  <div class="page-header">
    Kegiatan Harian 📘
    <div style="font-size:14px; font-weight:400; margin-top:4px;">
      Aktivitas anak setiap hari di sekolah
    </div>
  </div>

  <!-- CARD -->
  <div class="card">

    <!-- 🔥 FILTER -->
    <form method="GET" style="
      margin-bottom:18px;
      display:flex;
      gap:12px;
      align-items:center;
      flex-wrap:wrap;
    ">

      <div style="font-size:13px; color:#6b7280;">
        📅 Pilih Tanggal
      </div>

      <input 
        type="date" 
        name="date" 
        value="{{ request('date') }}"
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

    <!-- INFO FILTER -->
    @if(request('date'))
    <div style="font-size:13px; color:#6b7280; margin-bottom:10px;">
      Menampilkan kegiatan tanggal 
      <strong>
        {{ \Carbon\Carbon::parse(request('date'))->translatedFormat('d F Y') }}
      </strong>
    </div>
    @endif


@if(isset($activities) && $activities->count() > 0)

  <div style="display:flex; flex-direction:column; gap:16px;">

    @foreach($activities as $a)
    <div class="activity-card">

      <div class="activity-row">

        <!-- FOTO -->
        @if($a->photo)
          <img 
            src="{{ asset('storage/' . $a->photo) }}" 
            data-img="{{ asset('storage/' . $a->photo) }}"
            class="activity-img preview-img"
            style="cursor:pointer;"
          >
        @endif

        <!-- CONTENT -->
        <div class="activity-content">

          <!-- TANGGAL + HARI -->
          <div style="
            font-size:12px;
            color:#6b7280;
            margin-bottom:6px;
            display:flex;
            align-items:center;
            gap:6px;
          ">
            📅 {{ \Carbon\Carbon::parse($a->date)->translatedFormat('d F Y') }}

            <span style="
              background:#e5e7eb;
              color:#374151;
              padding:3px 10px;
              border-radius:999px;
              font-size:11px;
              font-weight:500;
            ">
              {{ \Carbon\Carbon::parse($a->date)->translatedFormat('l') }}
            </span>
          </div>

          <!-- JUDUL -->
          <div style="
            font-size:16px;
            font-weight:600;
            margin-bottom:6px;
            color:#111827;
          ">
            {{ $a->title }}
          </div>

          <!-- CATATAN -->
          @if($a->description)
          <div style="
            font-size:14px;
            color:#374151;
            line-height:1.5;
          ">
            {{ $a->description }}
          </div>
          @endif

        </div>

      </div>

    </div>
    @endforeach

  </div>

@else

  <!-- EMPTY STATE -->
  <div style="
    text-align:center;
    padding:50px;
    color:#6b7280;
    font-size:14px;
  ">
     Belum ada kegiatan hari ini
  </div>

@endif

  </div>

</div>

<!-- 🔥 MODAL IMAGE VIEW -->
<div id="imageModal" style="
  display:none;
  position:fixed;
  top:0;
  left:0;
  width:100%;
  height:100%;
  background:rgba(0,0,0,0.8);
  justify-content:center;
  align-items:center;
  z-index:999;
">

  <img id="modalImage" style="
    max-width:90%;
    max-height:90%;
    border-radius:10px;
  ">

</div>

<!-- 🔥 SCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', function () {

  document.querySelectorAll('.preview-img').forEach(img => {
    img.addEventListener('click', function() {
      const src = this.getAttribute('data-img');

      const modal = document.getElementById('imageModal');
      const modalImg = document.getElementById('modalImage');

      modalImg.src = src;
      modal.style.display = 'flex';
    });
  });

  document.getElementById('imageModal').addEventListener('click', function() {
    this.style.display = 'none';
  });

});
</script>

@endsection