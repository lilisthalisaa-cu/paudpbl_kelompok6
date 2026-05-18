@extends('website.layouts.app')

@section('title', 'Program Sekolah')

@section('content')

<!-- HERO -->
<section class="page-hero program-hero">

    <div class="overlay"></div>

    <div class="container hero-center">

        <h1>Program Sekolah</h1>

        <div class="breadcrumb">

            <a href="/" class="crumb crumb-home">
                Beranda
            </a>

            <a href="/program" class="crumb crumb-active">
                Program
            </a>

        </div>

    </div>

</section>

<!-- PROGRAM -->
<section class="program-section">

    <div class="container">

        <!-- TITLE -->
        <div class="section-title">

            <span class="program-badge">
                Program Kami
            </span>

            <h2>
                Pembelajaran Menyenangkan
                Untuk Anak Usia Dini
            </h2>

            <p class="program-desc">
                KB Roudlotul Ilmi menghadirkan berbagai program
                pendidikan yang interaktif, kreatif, dan menyenangkan
                untuk mendukung tumbuh kembang anak.
            </p>

        </div>

        <!-- GRID -->
        <div class="program-grid">

            <!-- 1 -->
            <div class="program-card">

                <img src="/images/1.jpeg" alt="Pembelajaran Aktif">

                <div class="program-content">

                    <h3>Pembelajaran Aktif</h3>

                    <p>
                        Belajar sambil bermain untuk meningkatkan
                        kreativitas dan keberanian anak.
                    </p>

                </div>

            </div>

            <!-- 2 -->
            <div class="program-card">

                <img src="/images/2.jpeg" alt="Karakter Anak">

                <div class="program-content">

                    <h3>Pengembangan Karakter</h3>

                    <p>
                        Membentuk sikap disiplin, mandiri,
                        dan tanggung jawab sejak dini.
                    </p>

                </div>

            </div>

            <!-- 3 -->
            <div class="program-card">

                <img src="/images/3.jpeg" alt="Pendidikan Agama">

                <div class="program-content">

                    <h3>Pendidikan Agama</h3>

                    <p>
                        Membiasakan anak berdoa,
                        sopan santun, dan akhlak mulia.
                    </p>

                </div>

            </div>

            <!-- 4 -->
            <div class="program-card">

                <img src="/images/4.jpeg" alt="Seni Kreativitas">

                <div class="program-content">

                    <h3>Seni & Kreativitas</h3>

                    <p>
                        Mengembangkan kemampuan seni,
                        imajinasi, dan motorik anak.
                    </p>

                </div>

            </div>

            <!-- 5 -->
            <div class="program-card">

                <img src="/images/5.jpeg" alt="Cinta Lingkungan">

                <div class="program-content">

                    <h3>Cinta Lingkungan</h3>

                    <p>
                        Mengajarkan pola hidup sehat,
                        bersih, dan peduli lingkungan.
                    </p>

                </div>

            </div>

            <!-- 6 -->
            <div class="program-card">

                <img src="/images/6.jpeg" alt="Tumbuh Kembang">

                <div class="program-content">

                    <h3>Stimulasi Tumbuh Kembang</h3>

                    <p>
                        Mendukung perkembangan sosial,
                        emosional, dan komunikasi anak.
                    </p>

                </div>

            </div>

            <!-- 7 -->
            <div class="program-card">

                <img src="/images/7.jpeg" alt="Persiapan SD">

                <div class="program-content">

                    <h3>Persiapan Masuk SD</h3>

                    <p>
                        Membantu kesiapan membaca,
                        menulis, dan berhitung dasar.
                    </p>

                </div>

            </div>

            <!-- 8 -->
            <div class="program-card">

                <img src="/images/8.jpeg" alt="Kerja Sama Orang Tua">

                <div class="program-content">

                    <h3>Kerja Sama Orang Tua</h3>

                    <p>
                        Menjalin komunikasi aktif
                        antara sekolah dan wali murid.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection