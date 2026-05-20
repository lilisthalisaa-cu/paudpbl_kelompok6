@extends('website.layouts.app')

@section('title', 'Profil Sekolah')

@section('content')

<section class="profile-hero">

    <div class="overlay"></div>

    <div class="container hero-center">

        <h1>Profil Sekolah</h1>

        <div class="breadcrumb">

            <a href="/">Beranda</a>

            <a href="/profile">
                Profil Sekolah
            </a>

        </div>

    </div>

</section>

<section class="profile-section container">

    <div class="profile-card">

        <div class="section-heading">

            <span class="heading-badge"></span>

            <div>

                <h2>
                    {{ $profile->title }}
                </h2>

                <div class="heading-line"></div>

            </div>

        </div>

        <div class="profile-description">

            <p>
                {{ $profile->description }}
            </p>

        </div>

    </div>

</section>

@endsection