<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Admin PAUD')</title>
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
      <div class="brand">KB Roudlotul Ilmi</div>

      <div class="menu">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.teachers.index') }}">Guru</a>
        <a href="{{ route('admin.students.index') }}">Siswa</a>

        <!-- 🔥 TAMBAHAN REKAP (TANPA MENGUBAH YANG LAIN) -->
        <a href="{{ route('admin.rekap.index') }}"
          class="{{ request()->routeIs('admin.rekap.*') ? 'active' : '' }}">
          Rekap
        </a>

        <a href="{{ route('admin.payment.index') }}">Pembayaran</a>

        <!-- 🔥 CMS -->
        <a href="{{ route('admin.profile.index') }}"
          class="{{ request()->routeIs('admin.profile.*') ? 'menu-profil active-profil' : '' }}">
          Profil
        </a>

        <a href="{{ route('admin.gallery.index') }}">Galeri</a>

        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
          @csrf
          <button class="btn-orange" type="submit">Logout</button>
        </form>
      </div>
    </div>
  </div>

  @yield('hero')

  <div class="main-container">
    @if(session('success'))
    <div style="background:#ecfdf5;border:1px solid #bbf7d0;color:#065f46;padding:12px;border-radius:12px;margin-bottom:12px;">
      {{ session('success') }}
    </div>
    @endif

    @yield('content')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>