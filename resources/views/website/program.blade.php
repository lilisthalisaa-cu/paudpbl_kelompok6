@extends('website.layouts.app')

@section('title', 'Program Sekolah')

@section('content')

{{-- HERO --}}
<section class="program-hero">

    <div class="overlay"></div>

    <div class="hero-center">

        <h1>
            Program Sekolah
        </h1>

    </div>

</section>

{{-- PROGRAM --}}
<section class="program-section">

    <div class="container">

        <div class="program-grid">

            @foreach($programs as $program)

                <div class="program-card">

                    <img
                        src="{{ asset('storage/' . $program->image) }}"
                        alt="{{ $program->title }}"
                    >

                    <div class="program-content">

                        <h3>
                            {{ $program->title }}
                        </h3>

                        <p>
                            {{ $program->description }}
                        </p>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>

@endsection