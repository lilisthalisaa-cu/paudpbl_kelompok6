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

        {{-- TOP --}}
        <div class="profile-top">

            <div>

                <h3 class="school-profile-title">
                    {{ $profile->title }}
                </h3>

                <p class="school-profile-description">
                    {{ $profile->description }}
                </p>

            </div>

            <a href="{{ route('admin.profile.edit', $profile->id) }}"
               class="school-profile-edit">

                ✏ Edit

            </a>

        </div>

        {{-- INFO --}}
        <div class="school-profile-list">

            <div class="school-profile-item">
                📍 {{ $profile->address }}
            </div>

            <div class="school-profile-item">
                ✉ {{ $profile->email }}
            </div>

            <div class="school-profile-item">
                ☎ {{ $profile->phone }}
            </div>

        </div>

        {{-- VISI MISI --}}
        <div class="vm-wrapper">

            <div class="vm-card">

                <h4>
                    Visi
                </h4>

                <p>
                    {{ $profile->vision }}
                </p>

            </div>

            <div class="vm-card">

                <h4>
                    Misi
                </h4>

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