@extends('website.layouts.app')

@section('title', 'Program Sekolah')

@section('content')

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