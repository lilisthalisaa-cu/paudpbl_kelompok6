<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'PAUD') }}</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md">

        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-green-600">KB Roudlotul Ilmi</h1>
            <p class="text-gray-500 text-sm">Sistem Informasi Sekolah</p>
        </div>

        {{ $slot }}

    </div>

</body>
</html>