
@extends('parent.layouts.app')

@section('title', 'Kalender Akademik')

@section('content')

@php
    use Carbon\Carbon;

    $month = (int) request('month', now()->month);
    $year = (int) request('year', now()->year);

    if ($month < 1 || $month > 12 || $year < 2000 || $year > 2100) {
        $month = now()->month;
        $year = now()->year;
    }

    $currentDate = Carbon::create($year, $month, 1);
    $previousMonth = $currentDate->copy()->subMonth();
    $nextMonth = $currentDate->copy()->addMonth();

    $startGrid = $currentDate->copy()->startOfWeek(Carbon::SUNDAY);
    $endGrid = $currentDate->copy()->endOfMonth()->endOfWeek(Carbon::SATURDAY);

    $monthEvents = $calendars->filter(function ($event) use ($currentDate) {
        $start = Carbon::parse($event->start_date)->startOfDay();
        $end = Carbon::parse($event->end_date ?? $event->start_date)->endOfDay();

        return $start->lte($currentDate->copy()->endOfMonth()->endOfDay())
            && $end->gte($currentDate->copy()->startOfMonth()->startOfDay());
    });

    $selectedDate = null;

    if (request()->filled('date')) {
        try {
            $selectedDate = Carbon::createFromFormat('!Y-m-d', request('date'));
        } catch (\Throwable $e) {
            $selectedDate = null;
        }

        if ($selectedDate && (
            $selectedDate->month !== $month ||
            $selectedDate->year !== $year
        )) {
            $selectedDate = null;
        }
    }

    $selectedEvents = $selectedDate
        ? $monthEvents->filter(function ($event) use ($selectedDate) {
            $start = Carbon::parse($event->start_date)->startOfDay();
            $end = Carbon::parse($event->end_date ?? $event->start_date)->endOfDay();

            return $start->lte($selectedDate->copy()->endOfDay())
                && $end->gte($selectedDate->copy()->startOfDay());
        })
        : collect();

    $categoryColors = [
        'Kegiatan Sekolah' => 'school',
        'Kegiatan Siswa' => 'student',
        'Pertemuan' => 'meeting',
        'Hari Libur' => 'holiday',
        'Libur' => 'holiday',
        'Ujian' => 'exam',
    ];

    $displayEvents = $selectedDate ? $selectedEvents : $monthEvents;
@endphp

<div class="academic-page">

    {{-- Header --}}
    <div class="academic-heading">
        <div class="academic-heading-icon">
            <i class="bi bi-calendar3"></i>
        </div>

        <div class="academic-heading-text">
            <h2>Kalender Akademik</h2>
            <p>
                Lihat jadwal kegiatan, hari libur, dan agenda sekolah
                dalam satu tahun ajaran.
            </p>
        </div>
    </div>

    {{-- Filter dan navigasi --}}
    <div class="academic-toolbar">

        <form method="GET"
              action="{{ route('parent.academic-calendars.index') }}"
              class="academic-filters">

            <div class="filter-group">
                <label for="academic-month">Bulan</label>
                <select name="month" id="academic-month">
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}"
                            {{ $month === $m ? 'selected' : '' }}>
                            {{ Carbon::create()->month($m)->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="filter-group">
                <label for="academic-year">Tahun</label>
                <select name="year" id="academic-year">
                    @for ($y = now()->year - 2; $y <= now()->year + 3; $y++)
                        <option value="{{ $y }}"
                            {{ $year === $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="filter-group">
                <label for="academic-category">Kategori</label>
                <select name="category" id="academic-category">
                    <option value="">Semua Kategori</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category }}"
                            {{ request('category') === $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="academic-filter-button">
                <i class="bi bi-funnel"></i>
                Terapkan
            </button>
        </form>

        <div class="month-navigation">
            <a href="{{ route('parent.academic-calendars.index', [
                'month' => $previousMonth->month,
                'year' => $previousMonth->year,
                'category' => request('category')
            ]) }}"
               class="month-arrow"
               aria-label="Bulan sebelumnya">
                <i class="bi bi-chevron-left"></i>
            </a>

            <div class="month-title">
                {{ $currentDate->translatedFormat('F Y') }}
            </div>

            <a href="{{ route('parent.academic-calendars.index', [
                'month' => $nextMonth->month,
                'year' => $nextMonth->year,
                'category' => request('category')
            ]) }}"
               class="month-arrow"
               aria-label="Bulan berikutnya">
                <i class="bi bi-chevron-right"></i>
            </a>

            <a href="{{ route('parent.academic-calendars.index') }}"
               class="today-button">
                Hari Ini
            </a>
        </div>
    </div>

    {{-- Kalender dan daftar kegiatan --}}
    <div class="academic-layout">

        <section class="academic-calendar-card">

            <div class="academic-card-heading">
                <div>
                    <i class="bi bi-calendar-week"></i>
                    <h3>Kalender Bulanan</h3>
                </div>

                <span class="academic-year-label">{{ $year }}</span>
            </div>

            <div class="calendar-grid">

                @foreach (['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'] as $day)
                    <div class="calendar-weekday {{ in_array($day, ['Min', 'Sab']) ? 'weekend' : '' }}">
                        {{ $day }}
                    </div>
                @endforeach

                @for (
                    $date = $startGrid->copy();
                    $date->lte($endGrid);
                    $date->addDay()
                )
                    @php
                        $cellDate = $date->copy();

                        $dayEvents = $monthEvents->filter(function ($event) use ($cellDate) {
                            $start = Carbon::parse($event->start_date)->startOfDay();
                            $end = Carbon::parse($event->end_date ?? $event->start_date)->endOfDay();

                            return $start->lte($cellDate->copy()->endOfDay())
                                && $end->gte($cellDate->copy()->startOfDay());
                        });

                        $isCurrentMonth = $cellDate->month === $month;
                        $isSelected = $selectedDate && $cellDate->isSameDay($selectedDate);
                        $isToday = $cellDate->isToday();

                        $cellUrl = route('parent.academic-calendars.index', [
                            'month' => $month,
                            'year' => $year,
                            'category' => request('category'),
                            'date' => $cellDate->toDateString(),
                        ]);
                    @endphp

                    <a href="{{ $cellUrl }}"
                       class="calendar-day
                           {{ !$isCurrentMonth ? 'outside-month' : '' }}
                           {{ $isToday ? 'today' : '' }}
                           {{ $isSelected ? 'selected-day' : '' }}
                           {{ in_array($cellDate->dayOfWeek, [0, 6]) ? 'weekend-day' : '' }}"
                       aria-label="{{ $cellDate->translatedFormat('d F Y') }}">

                        <span class="calendar-day-number">
                            {{ $cellDate->day }}
                        </span>

                        @if ($dayEvents->isNotEmpty())
                            <div class="calendar-event-dots">
                                @foreach ($dayEvents->take(3) as $event)
                                    <span class="event-dot dot-{{ $categoryColors[$event->category] ?? 'default' }}"></span>
                                @endforeach
                            </div>

                            <div class="calendar-event-labels">
                                @foreach ($dayEvents->take(2) as $event)
                                    <span class="calendar-event-label label-{{ $categoryColors[$event->category] ?? 'default' }}">
                                        {{ $event->title }}
                                    </span>
                                @endforeach

                                @if ($dayEvents->count() > 2)
                                    <small>+{{ $dayEvents->count() - 2 }} agenda</small>
                                @endif
                            </div>
                        @endif

                    </a>
                @endfor

            </div>

            <div class="calendar-legend">
                <span><i class="legend-dot dot-school"></i> Kegiatan Sekolah</span>
                <span><i class="legend-dot dot-student"></i> Kegiatan Siswa</span>
                <span><i class="legend-dot dot-meeting"></i> Pertemuan</span>
                <span><i class="legend-dot dot-holiday"></i> Hari Libur</span>
            </div>
        </section>

        {{-- Daftar agenda --}}
        <aside class="academic-agenda-card">

            <div class="academic-card-heading">
                <div>
                    <i class="bi bi-list-ul"></i>

                    <h3>
                        {{ $selectedDate
                            ? 'Agenda ' . $selectedDate->translatedFormat('d F')
                            : 'Daftar Kegiatan' }}
                    </h3>
                </div>

                <span class="agenda-count">
                    {{ $displayEvents->count() }}
                </span>
            </div>

            @forelse ($displayEvents as $event)
                @php
                    $eventColor = $categoryColors[$event->category] ?? 'default';
                @endphp

                <a href="{{ route('parent.academic-calendars.show', $event->id) }}"
                   class="agenda-item">

                    <span class="agenda-color-dot dot-{{ $eventColor }}"></span>

                    <div class="agenda-information">
                        <h4>{{ $event->title }}</h4>

                        <p class="agenda-date">
                            <i class="bi bi-calendar3"></i>

                            {{ Carbon::parse($event->start_date)->translatedFormat('d F Y') }}

                            @if ($event->end_date &&
                                Carbon::parse($event->end_date)->toDateString() !==
                                Carbon::parse($event->start_date)->toDateString())
                                – {{ Carbon::parse($event->end_date)->translatedFormat('d F Y') }}
                            @endif
                        </p>

                        @if ($event->description)
                            <p class="agenda-description">
                                {{ $event->description }}
                            </p>
                        @endif
                    </div>

                    <span class="agenda-category category-{{ $eventColor }}">
                        {{ $event->category ?: 'Lainnya' }}
                    </span>

                    <i class="bi bi-chevron-right agenda-chevron"></i>
                </a>

            @empty
                <div class="academic-empty-state">
                    <div class="empty-icon">
                        <i class="bi bi-calendar2-x"></i>
                    </div>

                    <h4>Belum Ada Agenda</h4>

                    <p>
                        @if ($selectedDate)
                            Belum ada kegiatan pada tanggal
                            {{ $selectedDate->translatedFormat('d F Y') }}.
                        @else
                            Belum ada kegiatan untuk bulan ini.
                        @endif
                    </p>

                    @if ($selectedDate)
                        <a href="{{ route('parent.academic-calendars.index', [
                            'month' => $month,
                            'year' => $year,
                            'category' => request('category')
                        ]) }}" class="reset-date-link">
                            Lihat semua agenda bulan ini
                        </a>
                    @endif
                </div>
            @endforelse

        </aside>

    </div>

</div>

@endsection
