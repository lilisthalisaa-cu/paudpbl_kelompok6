@extends('admin.layouts.app')

@section('title', 'Program Sekolah')

@section('content')

<div class="program-page">

    <div class="program-wrapper">

        {{-- HEADER --}}
        <div class="program-header">

            <div>

                <h1>
                    Program Sekolah
                </h1>

                <p>
                    Kelola program kegiatan sekolah.
                </p>

            </div>

            <a href="{{ route('admin.program.create') }}"
               class="btn-program">

                + Tambah Program

            </a>

        </div>

        {{-- FILTER --}}
        <div class="program-topbar">

            <div class="program-filter">

                <a href="{{ route('admin.program.index', ['type' => 'mingguan']) }}"
                   class="filter-btn {{ $type == 'mingguan' ? 'active' : '' }}">

                    📅 Mingguan

                </a>

                <a href="{{ route('admin.program.index', ['type' => 'bulanan']) }}"
                   class="filter-btn {{ $type == 'bulanan' ? 'active' : '' }}">

                    📅 Bulanan

                </a>

                <a href="{{ route('admin.program.index', ['type' => 'tahunan']) }}"
                   class="filter-btn {{ $type == 'tahunan' ? 'active' : '' }}">

                    📅 Tahunan

                </a>

            </div>

            <div class="program-search">

                <input
                    type="text"
                    placeholder="Cari program..."
                >

                <span>🔍</span>

            </div>

        </div>

        {{-- GRID --}}
        <div class="program-grid">

            @forelse($programs as $program)

                <div class="program-card">

                    <div class="program-image">

                        <img
                            src="{{ asset('storage/' . $program->image) }}"
                            alt="{{ $program->title }}"
                        >

                    </div>

                    <div class="program-content">

                        <h3>
                            {{ $program->title }}
                        </h3>

                        <p>
                            {{ $program->description }}
                        </p>

                    </div>

                    <div class="program-action">

                        <a href="{{ route('admin.program.edit', $program->id) }}"
                           class="btn-program-edit">

                            Edit

                        </a>

                        <form
                            action="{{ route('admin.program.destroy', $program->id) }}"
                            method="POST"
                            style="flex:1;"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn-program-delete"
                                onclick="return confirm('Yakin ingin menghapus program?')"
                            >

                                Hapus

                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <p>
                    Belum ada data program.
                </p>

            @endforelse

        </div>

    </div>

</div>

@endsection