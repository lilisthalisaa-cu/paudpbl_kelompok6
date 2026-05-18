@extends('website.layouts.app')

@section('title', 'Struktur Organisasi')

@section('content')

<!-- HERO -->
<section class="page-hero struktur-hero">

    <div class="overlay"></div>

    <div class="container hero-center">

        <h1>Struktur Organisasi</h1>

        <div class="breadcrumb">

            <a href="/" class="crumb crumb-home">
                Beranda
            </a>

            <a href="/struktur" class="crumb crumb-active">
                Struktur
            </a>

        </div>

    </div>

</section>

<!-- CONTENT -->
<section class="struktur-section">

    <div class="container">

        <!-- KEPALA SEKOLAH -->
        <div class="struktur-single">

            <div class="struktur-card utama">

                <img src="/images/kepala.jpeg" alt="Kepala Sekolah">

                <h3>Widyawati, S.Pd</h3>

                <span class="jabatan">
                    Kepala Sekolah
                </span>

                <p>
                    Memimpin seluruh kegiatan pendidikan
                    dan pengelolaan sekolah.
                </p>

            </div>

        </div>

        <!-- GARIS -->
        <div class="struktur-line-wrapper">

            <div class="line-vertical"></div>

            <div class="line-horizontal">

                <!-- GARIS TENGAH -->
                <span class="line-center"></span>

            </div>

        </div>

        <!-- STRUKTUR BAWAH -->
        <div class="struktur-grid-3">

            <!-- KELOMPOK A -->
            <div class="struktur-card-2">

                <img src="/images/guru.jpeg" alt="Kelompok A">

                <h3>Kelompok A</h3>

                <p>
                    Widi Mailia <br>
                    Adi Tuti Nurmita
                </p>

            </div>

            <!-- KELOMPOK A -->
            <div class="struktur-card-2">

                <img src="/images/guru.jpeg" alt="Kelompok A">

                <h3>Kelompok A</h3>

                <p>
                    Dinda Hesty Marlina
                </p>

            </div>

            <!-- KELOMPOK B -->
            <div class="struktur-card-2">

                <img src="/images/guru.jpeg" alt="Kelompok B">

                <h3>Kelompok B</h3>

                <p>
                    Retno Puji Astuti, S.Psi
                </p>

            </div>

        </div>

    </div>

</section>

@endsection