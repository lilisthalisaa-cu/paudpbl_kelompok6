@extends('website.layouts.app')

@section('title', 'Profil Sekolah')

@section('content')

<!-- HERO -->
<section class="profile-hero">

    <div class="overlay"></div>

    <div class="container hero-center">

        <h1>Profil Sekolah</h1>

        <div class="breadcrumb">

            <a href="/" class="crumb crumb-home">
                Beranda
            </a>

            <a href="/profile" class="crumb crumb-active">
                Profil Sekolah
            </a>

        </div>

    </div>

</section>

<!-- CONTENT -->
<section class="profile-section container">

    <div class="profile-card">

        <div class="section-heading">

            <span class="heading-badge"></span>

            <div>
                <h2>Tentang Kami</h2>
                <div class="heading-line"></div>
            </div>

        </div>

        <div class="profile-description">

            <p>
                KB Roudlotul Ilmi adalah lembaga pendidikan anak usia dini
                yang berfokus pada pembentukan karakter, kreativitas,
                dan kecerdasan anak.
            </p>

            <p>
                Kami menghadirkan lingkungan belajar yang nyaman,
                menyenangkan, dan modern untuk mendukung tumbuh
                kembang anak secara optimal.
            </p>

            <p>
                Dengan tenaga pendidik profesional dan metode pembelajaran
                interaktif, kami berkomitmen memberikan pengalaman belajar
                terbaik bagi seluruh peserta didik.
            </p>

        </div>

    </div>

</section>

@endsection