@extends('admin.layouts.app')

@section('content')

<div class="gallery-wrapper">

    <!-- HEADER -->
    <div class="gallery-card">

        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">

            <div>

                <h2 class="gallery-title">
                    Galeri Kegiatan
                </h2>

                <p class="gallery-subtitle">
                    Dokumentasi kegiatan dan aktivitas di KB Roudlotul Ilmi.
                </p>

            </div>

        </div>

        <!-- FILTER -->
        <form method="GET"
              action="{{ route('admin.gallery.index') }}"
              class="gallery-topbar">

            <select name="category"
                    class="gallery-select"
                    onchange="this.form.submit()">

                <option value="Semua Kategori">
                    Semua Kategori
                </option>

                <option value="Kegiatan Belajar"
                    {{ request('category') == 'Kegiatan Belajar' ? 'selected' : '' }}>
                    Kegiatan Belajar
                </option>

                <option value="Outdoor"
                    {{ request('category') == 'Outdoor' ? 'selected' : '' }}>
                    Outdoor
                </option>

                <option value="Keagamaan"
                    {{ request('category') == 'Keagamaan' ? 'selected' : '' }}>
                    Keagamaan
                </option>

                <option value="Acara"
                    {{ request('category') == 'Acara' ? 'selected' : '' }}>
                    Acara
                </option>

            </select>

            <div class="gallery-actions-top">

                <div class="gallery-search">

                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari galeri kegiatan..">

                    <span>🔍</span>

                </div>

                <!-- BUTTON TAMBAH -->
                <a href="{{ route('admin.gallery.create') }}"
                   class="gallery-btn-add">
                    + Tambah Galeri
                </a>

            </div>

        </form>

        <!-- LIST GALERI -->
        <div class="gallery-grid">

            @foreach($galleries as $gallery)

            <div class="gallery-item">

                <div class="gallery-image">

                    <img src="{{ asset('storage/' . $gallery->image) }}"
                         alt="Gallery">

                    <span class="gallery-badge">
                        {{ $gallery->category }}
                    </span>

                </div>

                <div class="gallery-content">

                    <h5>
                        {{ $gallery->title }}
                    </h5>

                    <p>
                        📅 {{ $gallery->created_at->format('d F Y') }}
                    </p>

                    <!-- ACTION -->
                    <div class="gallery-actions">

                        <!-- EDIT -->
                        <a href="{{ route('admin.gallery.edit', $gallery->id) }}"
                           class="gallery-btn-edit">
                            Edit
                        </a>

                        <!-- HAPUS -->
                        <form action="{{ route('admin.gallery.destroy', $gallery->id) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="gallery-btn-delete">
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

@endsection