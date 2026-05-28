@extends('website.layouts.app')

@section('content')

<!-- HERO -->
<section class="modern-hero">

    <img src="/images/home2.png" class="hero-bg" alt="Hero">

    <div class="hero-overlay"></div>

    <div class="container hero-inner">

        <div class="hero-text">

            <div class="hero-badge">
                <span></span>
                Pendidikan Anak Usia Dini
            </div>

            <h1>
                KB Roudlotul Ilmi
            </h1>

            <h2>
                Wujudkan Masa Depan Gemilang
            </h2>

            <p>
                Membentuk generasi anak yang cerdas,
                kreatif, dan berakhlak mulia.
            </p>

            <div class="hero-buttons">

                <a href="/gallery" class="hero-btn-primary">
                    Lihat Kegiatan →
                </a>

                <a href="/profile" class="hero-btn-secondary">
                    Selengkapnya →
                </a>

            </div>

        </div>

    </div>

</section>

<!-- FEATURES -->
<section class="features container">

    <div class="card">
        <div class="icon">🎓</div>

        <h3>Akreditasi B</h3>

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

@endsection