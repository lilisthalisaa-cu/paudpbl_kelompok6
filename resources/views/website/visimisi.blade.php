@extends('website.layouts.app')

@section('title', 'Visi & Misi')

@section('content')

<!-- HERO -->
<section class="visimisi-hero">

    <div class="overlay"></div>

    <div class="container hero-center">

        <h1>Visi & Misi</h1>

        <div class="breadcrumb">

            <a href="/" class="crumb crumb-home">
                Beranda
            </a>

            <a href="/visi-misi" class="crumb crumb-active">
                Visi & Misi
            </a>

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
                yang cerdas dan berakhlak mulia.
            </p>

        </div>

        <!-- MISI -->
        <div class="vm-card misi">

            <h3>MISI</h3>

            <p>
                Menyelenggarakan pendidikan yang menyenangkan,
                mengembangkan kreativitas anak, dan membentuk
                karakter disiplin serta mandiri.
            </p>

        </div>

    </div>

</section>

@endsection