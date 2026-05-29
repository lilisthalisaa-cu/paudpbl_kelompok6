@extends('teacher.layouts.app')

@section('title', 'Absensi Siswa Bulanan')

@section('content')

<div class="card">

  <div class="card-head top-head">

    <div>

      <h2 class="card-title">
        Presensi Siswa 
      </h2>

      <div class="muted">
        Input presensi siswa selama 1 bulan.
      </div>

    </div>

  </div>

  @if(session('success'))

    <div class="auth-error">
      {{ session('success') }}
    </div>

  @endif


  {{-- FILTER BULAN --}}
  <form method="GET">

    <div class="field">

      <label class="label">
        Pilih Bulan
      </label>

      <input
        type="month"
        name="month"
        class="input"
        value="{{ request('month', now()->format('Y-m')) }}"
        onchange="this.form.submit()">

    </div>

  </form>


  @php

    $selectedMonth =
      request('month', now()->format('Y-m'));

    $days = [];

    $start =
      \Carbon\Carbon::parse($selectedMonth)
      ->startOfMonth();

    $end =
      \Carbon\Carbon::parse($selectedMonth)
      ->endOfMonth();

    while ($start <= $end) {

      if ($start->dayOfWeek != 0) {

        $days[] = $start->copy();

      }

      $start->addDay();
    }

  @endphp


  {{-- FORM SIMPAN ABSENSI --}}
  <form method="POST"
        action="{{ route('teacher.student_attendance.bulk_store') }}">

    @csrf

    <input
      type="hidden"
      name="month"
      value="{{ $selectedMonth }}">

    <div class="attendance-month-wrapper">

      <table class="attendance-month-table">

        <thead>

          <tr>

            <th class="sticky-name">
              Nama Siswa
            </th>

            @foreach($days as $day)

              @php
                $dayClass =
                  'day-' .
                  str_replace('-', '_', $day->format('Y-m-d'));
              @endphp

              <th>

                <div class="day-name">
                  {{ $day->translatedFormat('D') }}
                </div>

                <div class="day-date">
                  {{ $day->format('d') }}
                </div>

                <button
                  type="button"
                  class="btn-h-all"
                  onclick="setAllDay('{{ $dayClass }}')">

                  H

                </button>

              </th>

            @endforeach

          </tr>

        </thead>

        <tbody>

          @foreach($students as $student)

            <tr>

              <td class="sticky-name student-name">
                {{ $student->name }}
              </td>

              @foreach($days as $day)

                @php

                  $dayClass =
                    'day-' .
                    str_replace('-', '_', $day->format('Y-m-d'));

                  $savedAttendance =
                    \App\Models\StudentAttendance::where(
                      'student_id',
                      $student->id
                    )

                    ->whereDate(
                      'date',
                      $day->format('Y-m-d')
                    )

                    ->first();

                @endphp

                <td>

                  <select
                      name="attendances[{{ $student->id }}][{{ $day->format('Y-m-d') }}][status]"
                      class="status-select attendance-select {{ $dayClass }}">

                    <option
                      value=""
                      {{ !$savedAttendance ? 'selected' : '' }}>
                      -
                    </option>

                    <option
                      value="HADIR"
                      {{ $savedAttendance && $savedAttendance->status == 'HADIR' ? 'selected' : '' }}>
                      H
                    </option>

                    <option
                      value="IZIN"
                      {{ $savedAttendance && $savedAttendance->status == 'IZIN' ? 'selected' : '' }}>
                      I
                    </option>

                    <option
                      value="SAKIT"
                      {{ $savedAttendance && $savedAttendance->status == 'SAKIT' ? 'selected' : '' }}>
                      S
                    </option>

                    <option
                      value="ALPA"
                      {{ $savedAttendance && $savedAttendance->status == 'ALPA' ? 'selected' : '' }}>
                      A
                    </option>

                  </select>

                </td>

              @endforeach

            </tr>

          @endforeach

        </tbody>

      </table>

    </div>

    <div style="margin-top:20px;">

      <button
        type="submit"
        class="btn-orange">

        Simpan

      </button>

    </div>

  </form>

</div>

<script>

  function setAllDay(dayClass)
  {
    const selects =
      document.querySelectorAll('.' + dayClass);

    selects.forEach(function(select) {

      select.value = 'HADIR';

    });
  }

</script>

@endsection