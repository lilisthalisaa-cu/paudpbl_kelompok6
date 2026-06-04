@extends('admin.layouts.app')

@section('title', 'Struktur Organisasi')

@section('content')

<div class="structure-page">

    <div class="structure-wrapper">

        {{-- HEADER --}}
        <div class="structure-header">

            <div>

                <h1>
                    Struktur Organisasi
                </h1>

                <p>
                    Kelola struktur organisasi sekolah.
                </p>

            </div>

            <a href="{{ route('admin.structure.create') }}"
               class="btn-structure-add">

                + Tambah Struktur

            </a>

        </div>

        {{-- STRUKTUR --}}
        <div class="structure-tree">

            {{-- KEPALA SEKOLAH --}}
            @foreach($structures->where('type', 'kepala') as $kepala)

            <div class="structure-top">

                <div class="structure-card structure-head-card">

                    <div class="structure-image">

                        <img
                            src="{{ asset('storage/' . $kepala->image) }}"
                            alt="Structure"
                        >

                    </div>

                    <div class="structure-content">

                        <h3>
                            {{ $kepala->name }}
                        </h3>

                        <span>
                            {{ $kepala->position }}
                        </span>

                        <p>
                            {{ $kepala->description }}
                        </p>

                    </div>

                    <div class="structure-action">

                        <a href="{{ route('admin.structure.edit', $kepala->id) }}"
                           class="btn-structure-edit">

                            Edit

                        </a>

                        <form
                           action="{{ route('admin.structure.destroy', $kepala->id) }}"
                            method="POST"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn-structure-delete"
                                onclick="confirmDelete(event, this.form, 'Hapus Data Struktur?')">

                                Hapus

                            </button>

                        </form>

                    </div>

                </div>

            </div>

            {{-- GARIS --}}
            <div class="structure-line-center"></div>

            <div class="structure-line-horizontal"></div>

            @endforeach

            {{-- GURU --}}
            <div class="structure-bottom">

                @foreach($structures->where('type', 'guru') as $guru)

                <div class="structure-item">

                    <div class="structure-line-top"></div>

                    <div class="structure-card structure-head-card">

                        <div class="structure-image">

                            <img
                                src="{{ asset('storage/' . $guru->image) }}"
                                alt="Structure"
                            >

                        </div>

                        <div class="structure-content">

                            <h3>
                                {{ $guru->name }}
                            </h3>

                            <span>
                                {{ $guru->position }}
                            </span>

                            <p>
                                {{ $guru->description }}
                            </p>

                        </div>

                        <div class="structure-action">

                            <a href="{{ route('admin.structure.edit', $guru->id) }}"
                               class="btn-structure-edit">

                                Edit

                            </a>

                            <form
                               action="{{ route('admin.structure.destroy', $guru->id) }}"
                                method="POST"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn-structure-delete"
                                    onclick="confirmDelete(event, this.form, 'Hapus Data Struktur?')">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </div>

</div>

@endsection