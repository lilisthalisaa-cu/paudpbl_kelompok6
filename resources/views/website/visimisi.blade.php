@extends('website.layouts.app')

@section('content')

<!-- HERO -->
<section class="visimisi-hero" style="background: url('/images/hero-sekolah.jpg') center/cover;">
  <div class="overlay"></div>

  <div class="container profile-hero-content">
    <h1>Visi & Misi</h1>

    <div class="breadcrumb">
      <a href="/" class="crumb crumb-home">Beranda</a>
      <a href="/visi-misi" class="crumb crumb-active">Visi & Misi</a>
    </div>
  </div>
</section>

<!-- CONTENT -->
<section class="visi-misi">
  <div class="container vm-grid">

    <!-- VISI -->
    <div class="vm-card visi">
      <h3>VISI</h3>
      <p>
        Menjadi lembaga pendidikan anak usia dini yang unggul,
        kreatif, dan berkarakter serta mampu mencetak generasi
        masa depan yang cerdas dan berakhlak mulia.
      </p>
    </div>

    <!-- MISI -->
    <div class="vm-card misi">
      <h3>MISI</h3>
      <p>
        Menyelenggarakan pendidikan yang menyenangkan,
        mengembangkan kreativitas anak, serta membentuk
        karakter yang disiplin, mandiri, dan bertanggung jawab.
      </p>
    </div>

  </div>
</section>

@endsection