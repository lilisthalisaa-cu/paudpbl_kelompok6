@extends('teacher.layouts.app')

@section('title','Perkembangan Anak Bulanan')

@section('content')

<div class="card development-card">

    <div class="card-head top-head">

        <div>
            <h2 class="card-title">
                Perkembangan Anak Bulanan
            </h2>

            <div class="muted">
                Input perkembangan seluruh siswa.
            </div>
        </div>

        <a href="{{ route('teacher.development.index') }}"
           class="btn-rekap">
            Lihat Rekap
        </a>

    </div>

    @if(session('success'))

        <div class="auth-error">
            {{ session('success') }}
        </div>

    @endif

    {{-- FILTER --}}
    <form method="GET"
          class="development-filter">

        <div>
            <label class="label">Bulan</label>

            <select name="month"
                    class="input"
                    onchange="this.form.submit()">

                @for($m = 1; $m <= 12; $m++)

                    <option value="{{ $m }}"
                        {{ $month == $m ? 'selected' : '' }}>

                        {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}

                    </option>

                @endfor

            </select>
        </div>

        <div>
            <label class="label">Tahun</label>

            <input type="number"
                   name="year"
                   class="input"
                   value="{{ $year }}"
                   onchange="this.form.submit()">
        </div>

    </form>

    {{-- FORM BULK --}}
    <form method="POST"
          action="{{ route('teacher.development.store') }}">

        @csrf

        <input type="hidden"
               name="month"
               value="{{ $month }}">

        <input type="hidden"
               name="year"
               value="{{ $year }}">

        <div class="development-table-wrap">

            <table class="development-table">

                <thead>

                    <tr>

                        <th>Nama Siswa</th>
                        <th>TB (cm)</th>
                        <th>BB (kg)</th>
                        <th>Catatan</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($students as $student)

                        @php
                            $item = $existing[$student->id] ?? null;
                        @endphp

                        <tr>

                            <td class="student-name">
                                {{ $student->name }}
                            </td>

                            <td>

                                <input type="number"
                                       class="input"
                                       name="developments[{{ $student->id }}][tb]"
                                       value="{{ $item->tb ?? '' }}">

                            </td>

                            <td>

                                <input type="number"
                                       class="input"
                                       name="developments[{{ $student->id }}][bb]"
                                       value="{{ $item->bb ?? '' }}">

                            </td>

                            <td>

                                <textarea
                                    class="input"
                                    rows="2"
                                    name="developments[{{ $student->id }}][description]">{{ $item->description ?? '' }}</textarea>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <div class="development-action">

            <button type="submit"
                    class="btn-orange">
                Simpan
            </button>

        </div>

    </form>

</div>

@endsection