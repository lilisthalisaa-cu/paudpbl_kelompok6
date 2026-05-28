@extends('parent.layouts.app')

@section('title', 'Kegiatan Harian')

@section('content')

<div class="container">

  <!-- HEADER -->
  <div class="page-header">

    Kegiatan Harian 📘

    <div style="
      font-size:14px;
      font-weight:400;
      margin-top:4px;
    ">
      Aktivitas anak setiap hari di sekolah
    </div>

  </div>

  <!-- CARD -->
  <div class="card">

    <!-- FILTER -->
    <form method="GET" style="
      margin-bottom:18px;
      display:flex;
      gap:12px;
      align-items:center;
      flex-wrap:wrap;
    ">

      <div style="
        font-size:13px;
        color:#6b7280;
      ">
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

    <div style="
      font-size:13px;
      color:#6b7280;
      margin-bottom:10px;
    ">

      Menampilkan kegiatan tanggal 

      <strong>
        {{ \Carbon\Carbon::parse(request('date'))->translatedFormat('d F Y') }}
      </strong>

    </div>

    @endif

    @if(isset($activities) && $activities->count() > 0)

    <div style="
      display:flex;
      flex-direction:column;
      gap:16px;
    ">

      @foreach($activities as $a)

      <div class="activity-card">

        <div class="activity-row">

          <!-- FOTO -->
          <div style="
            display:flex;
            flex-direction:column;
            align-items:center;
            gap:6px;
            min-width:120px;
          ">

            <div style="
              font-size:12px;
              font-weight:600;
              color:#6b7280;
              letter-spacing:.3px;
              text-transform:uppercase;
            ">

              Hasil Karya

            </div>

            @if($a->photo)

            <img 
              src="{{ route('parent.activity.photo', $a->id) }}" 
              data-img="{{ route('parent.activity.photo', $a->id) }}"
              class="activity-img preview-img"
              style="cursor:pointer;"
            >

            @endif

          </div>

          <!-- CONTENT -->
          <div class="activity-content">

            <!-- TANGGAL -->
            <div style="
              font-size:12px;
              color:#6b7280;
              margin-bottom:12px;
              display:flex;
              align-items:center;
              gap:6px;
              flex-wrap:wrap;
            ">

               {{ \Carbon\Carbon::parse($a->activity->date)->translatedFormat('d F Y') }}

              <span style="
                background:#e5e7eb;
                color:#374151;
                padding:3px 10px;
                border-radius:999px;
                font-size:11px;
                font-weight:500;
              ">

                {{ \Carbon\Carbon::parse($a->activity->date)->translatedFormat('l') }}

              </span>

            </div>

            <!-- JUDUL -->
            <div style="
              font-size:16px;
              font-weight:700;
              color:#374151;
              margin-bottom:16px;
            ">

               Aktivitas Hari Ini

            </div>

            <!-- LIST AKTIVITAS -->
            <div style="
              display:flex;
              flex-direction:column;
              gap:10px;
              padding-left: 4px;
            ">

              @if($a->desc_1)

              <div style="
                font-size:15px;
                color:#374151;
                line-height:1.6;
              ">
                • {{ $a->desc_1 }}
              </div>

              @endif

              @if($a->desc_2)

              <div style="
                font-size:15px;
                color:#374151;
                line-height:1.6;
              ">
                • {{ $a->desc_2 }}
              </div>

              @endif

              @if($a->desc_3)

              <div style="
                font-size:15px;
                color:#374151;
                line-height:1.6;
              ">
                • {{ $a->desc_3 }}
              </div>

              @endif

            </div>

          </div>

        </div>

      </div>

      @endforeach

    </div>

    @else

    <!-- EMPTY -->
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

<!-- MODAL -->
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

<!-- SCRIPT -->
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

  document.getElementById('imageModal').addEventListener('click', function () {

    this.style.display = 'none';

  });

});

</script>

@endsection