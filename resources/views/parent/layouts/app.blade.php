<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Dashboard Orang Tua')</title>

  

   <!-- 🔥 Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 
  <link rel="stylesheet" href="{{ asset('css/parent.css') }}">
</head>
<body class="parent-scope">

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
        <a href="{{ route('parent.dashboard') }}">Dashboard</a>
        
       <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button type="submit" class="btn-orange">Logout</button>
      </form>
      </div>
    </div>
  </div>

  <div class="container">
    @yield('content')
  </div>

   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>