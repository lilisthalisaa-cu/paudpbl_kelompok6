@extends('teacher.layouts.app')

@section('title','Edit Perkembangan Anak')

@section('content')

<div class="card development-card">

    <div class="card-head top-head">

        <div>
            <h2 class="card-title">
                Edit Perkembangan Anak
            </h2>

            <div class="muted">
                Perbarui data perkembangan siswa.
            </div>
        </div>

        <a href="{{ route('teacher.development.index') }}"
           class="btn-rekap">
            Kembali
        </a>

    </div>

    @if ($errors->any())

        <div class="auth-error">
            {{ $errors->first() }}
        </div>

    @endif

    <form action="{{ route('teacher.development.update', $data->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="form-grid">

            {{-- SISWA --}}
            <div class="full">

                <label class="label">
                    Nama Siswa
                </label>

                <select name="student_id"
                        class="input"
                        required>

                    @foreach($students as $s)

                        <option value="{{ $s->id }}"
                            {{ $data->student_id == $s->id ? 'selected' : '' }}>

                            {{ $s->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            {{-- BULAN --}}
            <div>

                <label class="label">
                    Bulan
                </label>

                <select name="month"
                        class="input"
                        required>

                    @for($m = 1; $m <= 12; $m++)

                        <option value="{{ $m }}"
                            {{ $data->month == $m ? 'selected' : '' }}>

                            {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}

                        </option>

                    @endfor

                </select>

            </div>

            {{-- TAHUN --}}
            <div>

                <label class="label">
                    Tahun
                </label>

                <input type="number"
                       name="year"
                       class="input"
                       value="{{ $data->year }}"
                       required>

            </div>

            {{-- TB --}}
            <div>

                <label class="label">
                    Tinggi Badan (cm)
                </label>

                <input type="number"
                       name="tb"
                       class="input"
                       value="{{ $data->tb }}">

            </div>

            {{-- BB --}}
            <div>

                <label class="label">
                    Berat Badan (kg)
                </label>

                <input type="number"
                       name="bb"
                       class="input"
                       value="{{ $data->bb }}">

            </div>

            {{-- CATATAN --}}
            <div class="full">

                <label class="label">
                    Catatan
                </label>

                <textarea name="description"
                          rows="4"
                          class="input"
                          required>{{ $data->description }}</textarea>

            </div>

        </div>

        <div class="development-action">

            <button type="submit"
                    class="btn-orange">

                Update

            </button>

        </div>

    </form>

</div>

@endsection