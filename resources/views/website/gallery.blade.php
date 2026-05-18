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

                <img src="/images/g1.jpeg" alt="Senam Pagi">

                <div class="gallery-content">

                    <h3>Senam Pagi</h3>

                    <p>
                        Kegiatan olahraga dan
                        menjaga kesehatan anak.
                    </p>

                </div>

            </div>

            <!-- 2 -->
            <div class="gallery-card">

                <img src="/images/g2.jpeg" alt="Belajar Bersama">

                <div class="gallery-content">

                    <h3>Belajar Bersama</h3>

                    <p>
                        Suasana belajar aktif
                        dan menyenangkan.
                    </p>

                </div>

            </div>

            <!-- 3 -->
            <div class="gallery-card">

                <img src="/images/g3.jpeg" alt="Kegiatan Agama">

                <div class="gallery-content">

                    <h3>Kegiatan Agama</h3>

                    <p>
                        Pembiasaan doa dan
                        pendidikan karakter.
                    </p>

                </div>

            </div>

            <!-- 4 -->
            <div class="gallery-card">

                <img src="/images/g4.jpeg" alt="Mewarnai">

                <div class="gallery-content">

                    <h3>Kegiatan Mewarnai</h3>

                    <p>
                        Melatih kreativitas
                        dan motorik anak.
                    </p>

                </div>

            </div>

            <!-- 5 -->
            <div class="gallery-card">

                <img src="/images/g5.jpeg" alt="Outdoor">

                <div class="gallery-content">

                    <h3>Kegiatan Outdoor</h3>

                    <p>
                        Belajar sambil bermain
                        di luar kelas.
                    </p>

                </div>

            </div>

            <!-- 6 -->
            <div class="gallery-card">

                <img src="/images/g6.jpeg" alt="Belajar Huruf">

                <div class="gallery-content">

                    <h3>Belajar Huruf</h3>

                    <p>
                        Mengenal huruf dan angka
                        dengan metode interaktif.
                    </p>

                </div>

            </div>

            <!-- 7 -->
            <div class="gallery-card">

                <img src="/images/g7.jpeg" alt="Foto Bersama">

                <div class="gallery-content">

                    <h3>Foto Bersama</h3>

                    <p>
                        Momen kebersamaan
                        anak dan guru.
                    </p>

                </div>

            </div>

            <!-- 8 -->
            <div class="gallery-card">

                <img src="/images/g8.jpeg" alt="Pentas Anak">

                <div class="gallery-content">

                    <h3>Pentas Anak</h3>

                    <p>
                        Penampilan dan
                        keberanian anak tampil.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection