<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'PAUD') }}</title>
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
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
    </div>
  </div>

  <div class="auth-wrap">
    {{ $slot }}
  </div>

</body>
</html>