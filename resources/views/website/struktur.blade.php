@extends('website.layouts.app')

@section('title', 'Struktur')

@section('content')

<div class="section">
  <h2>Kepemimpinan Sekolah</h2>

  <div class="struktur-grid">

    <div class="struktur-card utama">
      <img src="/images/PAUD_PROFILE.jpg" alt="">
      <h3>Kepala Sekolah</h3>
      <span class="jabatan">Kepala Sekolah</span>
      <p>Memimpin seluruh kegiatan pendidikan di sekolah.</p>
    </div>

    <div class="struktur-card">
      <img src="/images/PAUD_PROFILE.jpg" alt="">
      <h3>Wakil Kepala</h3>
      <span class="jabatan">Wakil Kepala</span>
      <p>Membantu kepala sekolah dalam pengelolaan sekolah.</p>
    </div>

  </div>
</div>


<!-- ✅ TAMBAHAN STRUKTUR ORGANISASI -->
<div class="struktur-section">

  <div class="container">

    <h2 class="struktur-title">Struktur Organisasi</h2>
    <div class="struktur-line"></div>

    <div class="struktur-box">

      <div class="kepala">
        Kepala Sekolah
      </div>

      <div class="struktur-grid-2">

        <div class="struktur-card-2">
          <h3>Bidang Akademik</h3>
          <p>Kurikulum, Pembelajaran, Penilaian</p>
        </div>

        <div class="struktur-card-2">
          <h3>Bidang Kesiswaan</h3>
          <p>Disiplin, Kegiatan, Pembinaan</p>
        </div>

        <div class="struktur-card-2">
          <h3>Bidang Sarana</h3>
          <p>Fasilitas, Perawatan, Keamanan</p>
        </div>

      </div>

    </div>

  </div>

</div>

@endsection