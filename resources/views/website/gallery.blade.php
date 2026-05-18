@extends('website.layouts.app')

@section('title', 'Galeri')

@section('content')

<!-- HERO -->
<section class="page-hero gallery-hero">

    <div class="overlay"></div>

    <div class="container hero-center">

        <h1>Galeri Kegiatan</h1>

        <div class="breadcrumb">

            <a href="/" class="crumb crumb-home">
                Beranda
            </a>

            <a href="/gallery" class="crumb crumb-active">
                Galeri
            </a>

        </div>

    </div>

</section>

<!-- GALLERY -->
<section class="gallery-section">

    <div class="container">

        <!-- TITLE -->
        <div class="gallery-title">

            <span class="gallery-badge">
                Dokumentasi Sekolah
            </span>

            <h2>
                Aktivitas Anak KB Roudlotul Ilmi
            </h2>

            <p>
                Berbagai kegiatan belajar, bermain,
                dan pengembangan karakter anak
                di lingkungan sekolah.
            </p>

        </div>

        <!-- GRID -->
        <div class="gallery-grid">

            <!-- 1 -->
            <div class="gallery-card">

                <img src="/images/berbagi takjil.jpeg" alt="Berbagi Takjil" loading="lazy">

                <div class="gallery-content">

                    <h3>Berbagi Takjil</h3>

                    <p>
                        Kegiatan berbagi dan
                        belajar peduli sesama.
                    </p>

                </div>

            </div>

            <!-- 2 -->
            <div class="gallery-card">

                <img src="/images/edukasi ke margo utomo.jpg" alt="Edukasi Margot Utomo" loading="lazy">

                <div class="gallery-content">

                    <h3>Edukasi ke Margot Utomo</h3>

                    <p>
                        Anak mengenal hewan
                        dan lingkungan alam.
                    </p>

                </div>

            </div>

            <!-- 3 -->
            <div class="gallery-card">

                <img src="/images/gebyar paud tema buah.jpeg" alt="Gebyar Tema Buah" loading="lazy">

                <div class="gallery-content">

                    <h3>Gebyar Tema Buah</h3>

                    <p>
                        Belajar mengenal buah
                        dengan kegiatan kreatif.
                    </p>

                </div>

            </div>

            <!-- 4 -->
            <div class="gallery-card">

                <img src="/images/hasil karya anak membuat topi dari kardus.jpeg" alt="Karya Anak" loading="lazy">

                <div class="gallery-content">

                    <h3>Karya Topi Kardus</h3>

                    <p>
                        Melatih kreativitas dan
                        motorik anak sejak dini.
                    </p>

                </div>

            </div>

            <!-- 5 -->
            <div class="gallery-card">

                <img src="/images/juara lomba mom and kids.jpg" alt="Juara Lomba" loading="lazy">

                <div class="gallery-content">

                    <h3>Juara Mom & Kids</h3>

                    <p>
                        Prestasi anak dalam
                        kegiatan perlombaan.
                    </p>

                </div>

            </div>

            <!-- 6 -->
            <div class="gallery-card">

                <img src="/images/kunjungan dari puskesmas untuk kesehatan gigi.jpeg" alt="Kesehatan Gigi" loading="lazy">

                <div class="gallery-content">

                    <h3>Kesehatan Gigi</h3>

                    <p>
                        Edukasi kesehatan gigi
                        bersama puskesmas.
                    </p>

                </div>

            </div>

            <!-- 7 -->
            <div class="gallery-card">

                <img src="/images/menanam.jpg" alt="Menanam" loading="lazy">

                <div class="gallery-content">

                    <h3>Kegiatan Menanam</h3>

                    <p>
                        Belajar mencintai alam
                        dan lingkungan sekitar.
                    </p>

                </div>

            </div>

            <!-- 8 -->
            <div class="gallery-card">

                <img src="/images/outing class pengenalan kereta api.jpeg" alt="Outing Class" loading="lazy">

                <div class="gallery-content">

                    <h3>Outing Class</h3>

                    <p>
                        Pengenalan kereta api
                        melalui kegiatan edukatif.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection