@extends('admin.layouts.app')

@section('content')

<div class="school-profile-wrapper">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="title">
                Profil Sekolah
            </h2>

            <p class="subtitle">
                Informasi profil sekolah.
            </p>

        </div>

        @if(!$profile)

            <a href="{{ route('admin.profile.create') }}"
               class="btn-add">
                + Tambah Profil
            </a>

        @endif

    </div>

    @if($profile)

    <div class="school-profile-card">

        <div class="school-profile-image">

            <img src="{{ $profile->image
                ? asset('storage/' . $profile->image)
                : asset('images/sekolah.jpg') }}">

        </div>

        <div class="school-profile-info">

            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">

                <div>

                    <h3 class="school-profile-title">
                        {{ $profile->title }}
                    </h3>

                </div>

                <a href="{{ route('admin.profile.edit', $profile->id) }}"
                   class="school-profile-edit">

                    ✏ Edit

                </a>

            </div>

            <div class="school-profile-list">

                <div class="school-profile-item">
                    {{ $profile->description }}
                </div>

                <div class="school-profile-item">
                    📍 {{ $profile->address }}
                </div>

                <div class="school-profile-item">
                    ✉ {{ $profile->email }}
                </div>

                <div class="school-profile-item">
                    ☎️ {{ $profile->phone }}
                </div>

            </div>

        </div>

    </div>

    <!-- VISI MISI -->
    <div class="school-profile-section mt-4">

        <div class="school-profile-grid">

            <div class="school-profile-box">

                <strong>
                    Visi
                </strong>

                <p>
                    {{ $profile->vision }}
                </p>

            </div>

            <div class="school-profile-box">

                <strong>
                    Misi
                </strong>

                <p>
                    {!! nl2br(e($profile->mission)) !!}
                </p>

            </div>

        </div>

    </div>

    @else

    <div class="card-table text-center">

        <h4 class="mb-3">
            Belum ada profil sekolah
        </h4>

        <a href="{{ route('admin.profile.create') }}"
           class="btn-add">

            + Tambah Profil

        </a>

    </div>

    @endif

</div>

@endsection