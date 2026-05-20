@extends('website.layouts.app')

@section('title', 'Contact')

@section('content')

<section class="contact-hero">

    <div class="container">

        <div class="contact-hero-box">

            <div class="contact-hero-left">

                <span class="contact-badge">
                    Hubungi Kami
                </span>

                <h1>
                    Kami Siap Membantu Anda
                </h1>

            </div>

        </div>

    </div>

</section>

<section class="contact-section">

    <div class="container">

        <div class="contact-grid">

            <div class="contact-info">

                <h2>Informasi Kontak</h2>

                <div class="contact-card">

                    <h4>Alamat</h4>

                    <p>
                        {{ $profile->address }}
                    </p>

                </div>

                <div class="contact-card">

                    <h4>Telepon</h4>

                    <p>
                        {{ $profile->phone }}
                    </p>

                </div>

                <div class="contact-card">

                    <h4>Email</h4>

                    <p>
                        {{ $profile->email }}
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection