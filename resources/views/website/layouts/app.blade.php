<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <!-- RESPONSIVE -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>KB Roudlotul Ilmi</title>

    <link rel="stylesheet" href="{{ asset('css/website.css') }}">
</head>

<body>

    @include('website.components.navbar')

    @yield('content')

    @include('website.components.footer')

    <script>
        function toggleMenu() {
            document.getElementById("menu").classList.toggle("active");
        }

        document.addEventListener("DOMContentLoaded", function() {

            const dropdowns = document.querySelectorAll(".dropdown");

            dropdowns.forEach(function(drop) {

                const trigger = drop.querySelector(".dropdown-toggle");

                trigger.addEventListener("click", function(e) {

                    if (window.innerWidth <= 992) {

                        e.preventDefault();

                        dropdowns.forEach(d => {
                            if (d !== drop) {
                                d.classList.remove("active");
                            }
                        });

                        drop.classList.toggle("active");
                    }
                });

            });

        });
    </script>

</body>

</html>