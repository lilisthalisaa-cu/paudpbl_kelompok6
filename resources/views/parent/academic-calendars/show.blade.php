
@extends('parent.layouts.app')

@section('title', 'Detail Kalender Akademik')

@section('content')
@php
    use Carbon\Carbon;

    $startDate = $academicCalendar->start_date
        ? Carbon::parse($academicCalendar->start_date)
        : null;

    $endDate = $academicCalendar->end_date
        ? Carbon::parse($academicCalendar->end_date)
        : null;

    $categoryColors = [
        'Libur' => 'detail-badge-holiday',
        'Hari Libur' => 'detail-badge-holiday',
        'Kegiatan' => 'detail-badge-activity',
        'Akademik' => 'detail-badge-academic',
        'Ujian' => 'detail-badge-exam',
    ];

    $categoryClass = $categoryColors[$academicCalendar->category]
        ?? 'detail-badge-default';
@endphp

<div class="academic-detail-page">

    {{-- Tombol kembali --}}
    <a href="{{ route('parent.academic-calendars.index', request()->only('month', 'year', 'category')) }}"
       class="academic-detail-back">
        <i class="bi bi-arrow-left"></i>
        Kembali ke Kalender
    </a>

    {{-- Header --}}
    <div class="academic-detail-heading">
        <div class="academic-detail-icon">
            <i class="bi bi-calendar-event"></i>
        </div>

        <div>
            <h1>Detail Agenda</h1>
            <p>Informasi lengkap agenda akademik sekolah.</p>
        </div>
    </div>

    {{-- Konten detail --}}
    <div class="academic-detail-card">

        <div class="academic-detail-banner">
            <div class="academic-detail-banner-icon">
                <i class="bi bi-calendar2-check"></i>
            </div>

            <span class="academic-detail-eyebrow">
                KALENDER AKADEMIK
            </span>

            <h2>{{ $academicCalendar->title }}</h2>

            <span class="academic-detail-category {{ $categoryClass }}">
                {{ $academicCalendar->category ?: 'Agenda Sekolah' }}
            </span>
        </div>

        <div class="academic-detail-content">

            <div class="academic-detail-section-title">
                <i class="bi bi-info-circle"></i>
                Informasi Agenda
            </div>

            <div class="academic-detail-info-grid">

                <div class="academic-detail-info-item">
                    <div class="academic-detail-info-icon">
                        <i class="bi bi-calendar-date"></i>
                    </div>

                    <div>
                        <span class="academic-detail-label">
                            Tanggal Mulai
                        </span>

                        <strong>
                            {{ $startDate ? $startDate->translatedFormat('d F Y') : '-' }}
                        </strong>
                    </div>
                </div>

                <div class="academic-detail-info-item">
                    <div class="academic-detail-info-icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>

                    <div>
                        <span class="academic-detail-label">
                            Tanggal Selesai
                        </span>

                        <strong>
                            {{ $endDate ? $endDate->translatedFormat('d F Y') : '-' }}
                        </strong>
                    </div>
                </div>

                <div class="academic-detail-info-item">
                    <div class="academic-detail-info-icon">
                        <i class="bi bi-tag"></i>
                    </div>

                    <div>
                        <span class="academic-detail-label">
                            Kategori Agenda
                        </span>

                        <strong>
                            {{ $academicCalendar->category ?: 'Tidak ditentukan' }}
                        </strong>
                    </div>
                </div>

            </div>

            <div class="academic-detail-description">
                <div class="academic-detail-section-title">
                    <i class="bi bi-card-text"></i>
                    Deskripsi Kegiatan
                </div>

                @if ($academicCalendar->description)
                    <p>{{ $academicCalendar->description }}</p>
                @else
                    <p class="academic-detail-empty-description">
                        Belum ada deskripsi untuk agenda ini.
                    </p>
                @endif
            </div>

            <div class="academic-detail-note">
                <i class="bi bi-info-circle-fill"></i>
                <span>
                    Silakan perhatikan tanggal dan informasi agenda
                    sebagai panduan kegiatan sekolah anak.
                </span>
            </div>

        </div>

        <div class="academic-detail-footer">
            <a href="{{ route('parent.academic-calendars.index', request()->only('month', 'year', 'category')) }}"
               class="academic-detail-button">
                <i class="bi bi-arrow-left"></i>
                Kembali ke Daftar Kalender
            </a>
        </div>

    </div>
</div>
@endsection
