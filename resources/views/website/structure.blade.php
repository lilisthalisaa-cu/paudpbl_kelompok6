@extends('website.layouts.app')

@section('title', 'Struktur Organisasi')

@section('content')

<section class="struktur-hero">

    <div class="overlay"></div>

    <div class="container hero-center">

        <h1>
            Struktur Organisasi
        </h1>

        <div class="breadcrumb">

            <a
                href="/"
                class="crumb crumb-home"
            >
                Beranda
            </a>

            <a
                href="/structure"
                class="crumb crumb-active"
            >
                Struktur Organisasi
            </a>

        </div>

    </div>

</section>

<section class="struktur-section">

    <div class="container">

        @if($kepala)

            <div class="struktur-single">

                <div class="struktur-card utama">

                    <img
                        src="{{ asset('storage/' . $kepala->image) }}"
                        alt="{{ $kepala->name }}"
                    >

                    <h3>
                        {{ $kepala->name }}
                    </h3>

                    <span class="jabatan">
                        {{ $kepala->position }}
                    </span>

                    <p>
                        {{ $kepala->description }}
                    </p>

                </div>

            </div>

        @endif

        <div class="struktur-grid-3">

            @foreach($gurus as $guru)

                <div class="struktur-card-2">

                    <img
                        src="{{ asset('storage/' . $guru->image) }}"
                        alt="{{ $guru->name }}"
                    >

                    <h3>
                        {{ $guru->position }}
                    </h3>

                    <p>
                        {{ $guru->name }}
                    </p>

                </div>

            @endforeach

        </div>

    </div>

</section>

@endsection