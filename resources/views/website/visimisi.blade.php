@extends('website.layouts.app')

@section('title', 'Visi & Misi')

@section('content')

<section class="visimisi-hero">

    <div class="overlay"></div>

    <div class="container hero-center">

        <h1>
            Visi & Misi
        </h1>

        <div class="breadcrumb">

            <a
                href="/"
                class="crumb crumb-home"
            >
                Beranda
            </a>

            <a
                href="/visimisi"
                class="crumb crumb-active"
            >
                Visi & Misi
            </a>

        </div>

    </div>

</section>

<section class="visi-misi">

    <div class="container vm-grid">

        <div class="vm-card visi">

            <h3>
                VISI
            </h3>

            <p>
                {{ $profile->vision }}
            </p>

        </div>

        <div class="vm-card misi">

            <h3>
                MISI
            </h3>

            <p>
                {{ $profile->mission }}
            </p>

        </div>

    </div>

</section>

@endsection