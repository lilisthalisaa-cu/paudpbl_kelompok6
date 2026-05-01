@extends('website.layouts.app')

@section('title', 'Galeri')

@section('content')

<div class="section">
  <h2>Galeri Kegiatan</h2>

  <div class="gallery">
    @foreach($activities as $a)
    <div class="gallery-card">
      <img src="{{ asset('storage/' . $a->photo) }}" alt="">
      <div class="content">
        <h4>{{ $a->title }}</h4>
        <p>{{ $a->description }}</p>
      </div>
    </div>
    @endforeach
  </div>
</div>

@endsection