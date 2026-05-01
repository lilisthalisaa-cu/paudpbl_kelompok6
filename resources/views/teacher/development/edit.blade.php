@extends('teacher.layouts.app')

@section('title','Edit Perkembangan Anak')

@section('content')

<div class="card">

  <h2>Edit Perkembangan Anak</h2>

{{-- ERROR MESSAGE --}}
@if ($errors->any())
  <div style="color:red; margin-bottom:10px;">
    {{ $errors->first() }}
  </div>
@endif

<!-- <form action="{{ route('teacher.development.update', $data->id) }}" method="POST"> -->

  <style>
    .form-group {
      margin-bottom: 16px;
    }

    .form-group label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      color: #374151;
    }

    .form-control {
      width: 100%;
      padding: 8px 10px;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      font-size: 14px;
    }

    textarea.form-control {
      resize: none;
    }

    .btn-primary {
      background: #10b981;
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 6px;
      cursor: pointer;
    }

    .btn-primary:hover {
      background: #059669;
    }

    .btn-secondary {
      margin-left: 10px;
      color: #6b7280;
      text-decoration: none;
    }
  </style>

  <form action="{{ route('teacher.development.update', $data->id) }}" method="POST">
    @csrf
    @method('PUT')

    {{-- Nama Siswa --}}
    <div class="form-group">
      <label>Nama Siswa</label>
      <select name="student_id" class="form-control">
        @foreach($students as $s)
          <option value="{{ $s->id }}" {{ $data->student_id == $s->id ? 'selected' : '' }}>
            {{ $s->name }}
          </option>
        @endforeach
      </select>
    </div>

    {{-- Bulan --}}
    <div class="form-group">
      <label>Bulan</label>
      <input type="month" name="month" value="{{ $data->month }}" class="form-control" required>
    </div>

    {{-- Tahun --}}
    <div class="form-group">
      <label>Tahun</label>
      <input type="number" name="year" value="{{ $data->year }}" class="form-control" required>
    </div>

    {{-- 🔥 TAMBAHAN TB --}}
    <div class="form-group">
      <label>Tinggi Badan (cm)</label>
      <input type="number" name="tb" class="form-control" value="{{ $data->tb ?? '' }}">
    </div>

    {{-- 🔥 TAMBAHAN BB --}}
    <div class="form-group">
      <label>Berat Badan (kg)</label>
      <input type="number" name="bb" class="form-control" value="{{ $data->bb ?? '' }}">
    </div>

    {{-- Catatan --}}
    <div class="form-group">
      <label>Catatan</label>
      <textarea name="description" rows="4" class="form-control" required>{{ $data->description }}</textarea>
    </div>

    {{-- Tombol --}}
    <button type="submit" class="btn-primary">
      Update
    </button>

    <a href="{{ route('teacher.development.index') }}" class="btn-secondary">
      Batal
    </a>

  </form>

</div>

@endsection