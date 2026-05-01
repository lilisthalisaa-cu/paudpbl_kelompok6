@extends('website.layouts.app')

@section('content')

<!-- HERO -->

<section class="hero">
  <div class="overlay"></div>

  <div class="container hero-content fade-in">
    <h1>PAUD Raudhatul Ilmi</h1>
    <h2>Wujudkan Masa Depan Gemilang</h2>
    <p>Membentuk generasi anak yang cerdas, kreatif, dan berakhlak mulia</p>

<div class="hero-btn">
  <a href="/gallery" class="btn">Lihat Kegiatan</a>
  <a href="#" class="btn-outline">Selengkapnya</a>
</div>

  </div>
</section>

<!-- FEATURES -->

<section class="features container fade-in">

  <div class="card">
    <div class="icon">🎓</div>
    <h3>Akreditasi A</h3>
    <p>Standar pendidikan terbaik</p>
  </div>

  <div class="card">
    <div class="icon">👩‍🏫</div>
    <h3>Guru Profesional</h3>
    <p>Tenaga pendidik berpengalaman</p>
  </div>

  <div class="card">
    <div class="icon">🏫</div>
    <h3>Fasilitas Nyaman</h3>
    <p>Lingkungan belajar nyaman</p>
  </div>

  <div class="card">
    <div class="icon">❤️</div>
    <h3>Pendidikan Karakter</h3>
    <p>Pembentukan akhlak anak</p>
  </div>

</section>

<!-- ABOUT -->

<section class="about container fade-in">
  <div>
    <img src="/images/LogoPaud.jpeg" alt="Sekolah">
  </div>

  <div>
    <h2>Sekolah Terbaik Untuk Masa Depan Anak</h2>
    <p>
      PAUD Raudhatul Ilmi memberikan pendidikan terbaik untuk anak usia dini
      dengan pendekatan modern, menyenangkan, dan berbasis karakter.
    </p>
  </div>
</section>

<!-- GALLERY -->

<section class="gallery container fade-in">
  <h2 class="section-title">Kegiatan Anak</h2>

  <div class="gallery-grid">
    <img src="/images/LogoPaud.jpeg" alt="">
    <img src="/images/LogoPaud.jpeg" alt="">
    <img src="/images/LogoPaud.jpeg" alt="">
    <img src="/images/LogoPaud.jpeg" alt="">
  </div>
</section>

@endsection
