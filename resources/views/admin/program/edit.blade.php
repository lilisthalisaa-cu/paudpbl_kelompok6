@extends('admin.layouts.app')

@section('title', 'Edit Program')

@section('content')

<div class="program-form-page">

    <div class="program-form-wrapper">

        @if ($errors->any())

    <div class="error-box">

        <strong>
            Gagal menyimpan program
        </strong>

        <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

        {{-- HEADER --}}
        <div class="program-form-header">

            <div>

                <h1>
                    Edit Program
                </h1>

                <p>
                    Perbarui data program sekolah.
                </p>

            </div>

        </div>

        {{-- FORM --}}
        <form
            action="{{ route('admin.program.update', $program->id) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')

            <div class="program-form-grid">

                {{-- TITLE --}}
                <div class="program-form-group">

                    <label>
                        Nama Program
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ $program->title }}"
                        required
                    >

                </div>

                {{-- TYPE --}}
                <div class="program-form-group">

                    <label>
                        Jenis Program
                    </label>

                    <select
                        name="type"
                        required
                    >

                        <option
                            value="mingguan"
                            {{ $program->type == 'mingguan' ? 'selected' : '' }}
                        >
                            Mingguan
                        </option>

                        <option
                            value="bulanan"
                            {{ $program->type == 'bulanan' ? 'selected' : '' }}
                        >
                            Bulanan
                        </option>

                        <option
                            value="tahunan"
                            {{ $program->type == 'tahunan' ? 'selected' : '' }}
                        >
                            Tahunan
                        </option>

                    </select>

                </div>

                {{-- IMAGE --}}
                <div class="program-form-group full">

                    <label>
                        Foto Program
                    </label>

                    <input
                        type="file"
                        name="image"
                    >

                    <img
                        src="{{ asset('storage/' . $program->image) }}"
                        width="140"
                        style="margin-top:12px;border-radius:14px;"
                    >

                </div>

                {{-- DESCRIPTION --}}
                <div class="program-form-group full">

                    <label>
                        Deskripsi
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        required
                    >{{ $program->description }}</textarea>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="program-form-action">

                <a href="{{ route('admin.program.index') }}"
                   class="btn-program-cancel">

                    Kembali

                </a>

                <button
                    type="submit"
                    class="btn-program-save"
                >

                    Update Program

                </button>

            </div>

        </form>

    </div>

</div>

@endsection