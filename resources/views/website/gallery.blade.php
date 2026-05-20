@extends('website.layouts.app')

@section('title', 'Galeri')

@section('content')

<section class="page-hero gallery-hero">

    <div class="overlay"></div>

    <div class="container hero-center">

        <h1>Galeri Kegiatan</h1>

    </div>

</section>

<section class="gallery-section">

    <div class="container">

        <div class="gallery-grid">

            @foreach($galleries as $gallery)

                <div class="gallery-card">

                    <img
                        src="{{ asset('storage/' . $gallery->image) }}"
                        alt="{{ $gallery->title }}"
                    >

                    <div class="gallery-content">

                        <h3>
                            {{ $gallery->title }}
                        </h3>

                        <p>
                            {{ $gallery->category }}
                        </p>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>

@endsection