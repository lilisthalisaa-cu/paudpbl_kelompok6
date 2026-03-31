<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Admin PAUD')</title>
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

  <div class="topbar">
    <div class="wrap">
      <div class="left">
        <span>Dusun Pasinan Timur, Singojuruh, Banyuwangi</span>
        <span>kbroudlotulilmisngojuruh@gmail.com</span>
      </div>
      <div>+62 821 4518 2975</div>
    </div>
  </div>

  <div class="navbar">
    <div class="wrap">
      <div class="brand">PAUD Raudhatul Ilmi</div>

      <div class="menu">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.teachers.index') }}">Guru</a>
        <a href="{{ route('admin.students.index') }}">Siswa</a>
        {{-- route('admin.recap.teachers') --}}
        {{-- route('admin.recap.students') --}}
        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
          @csrf
          <button class="btn-orange" type="submit">Logout</button>
        </form>
      </div>
    </div>
  </div>

  @yield('hero')

  <div class="container">
    @if(session('success'))
      <div style="background:#ecfdf5;border:1px solid #bbf7d0;color:#065f46;padding:12px;border-radius:12px;margin-bottom:12px;">
        {{ session('success') }}
      </div>
    @endif

    @yield('content')
  </div>

</body>

</body>
</html>