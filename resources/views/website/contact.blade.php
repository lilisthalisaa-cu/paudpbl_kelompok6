@extends('website.layouts.app')

@section('title', 'Contact')

@section('content')

<section class="page-hero gallery-hero">

    <div class="overlay"></div>

    <div class="container hero-center">

        <h1>
            Hubungi Kami
        </h1>

    </div>

</section>

<section class="contact-section">

    <div class="container">

        <div class="contact-grid">

            {{-- INFORMASI --}}
            <div class="contact-info">

                <h2>
                    Informasi Kontak
                </h2>

                <div class="contact-card">

                    <h4>
                        📍 Alamat
                    </h4>

                    <p>
                        {{ $profile->address }}
                    </p>

                </div>

                <div class="contact-card">

                    <h4>
                        ☎ Telepon
                    </h4>

                    <p>
                        {{ $profile->phone }}
                    </p>

                </div>

                <div class="contact-card">

                    <h4>
                        ✉ Email
                    </h4>

                    <p>
                        {{ $profile->email }}
                    </p>

                </div>

            </div>

            {{-- FOTO --}}
            <div class="contact-image">

                <img
                    src="{{ asset('images/paud.jpeg') }}"
                    alt="PAUD"
                >

            </div>

        </div>

    </div>

</section>

@endsection