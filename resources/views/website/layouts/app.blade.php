<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">

  <!-- FIX UTAMA BIAR RESPONSIVE (WAJIB) -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>PAUD Raudhatul Ilmi</title>

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/website.css') }}">
</head>

<body>

  @include('website.components.navbar')

  @yield('content')

  @include('website.components.footer')

  <!-- JS -->
  <script>
    function toggleMenu() {
      document.getElementById("menu").classList.toggle("active");
    }

    // 🔥 FIX DROPDOWN MOBILE (PASTI KENA)
    document.addEventListener("DOMContentLoaded", function() {

      const dropdowns = document.querySelectorAll(".dropdown");

      dropdowns.forEach(function(drop) {
        const trigger = drop.querySelector("a");

        trigger.addEventListener("click", function(e) {
          if (window.innerWidth <= 768) {
            e.preventDefault();

            // tutup dropdown lain
            dropdowns.forEach(d => {
              if (d !== drop) d.classList.remove("active");
            });

            // toggle dropdown ini
            drop.classList.toggle("active");
          }
        });
      });

    });
  </script>

</body>

</html>