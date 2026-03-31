<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #f3f4f6;
        }

        /* TOPBAR */
        .topbar {
            background: #0f766e;
            color: white;
            padding: 8px 20px;
            font-size: 14px;
            display: flex;
            justify-content: space-between;
        }

        /* NAVBAR */
        .navbar {
            background: #e5e7eb;
            padding: 15px 20px;
            font-weight: bold;
            color: #065f46;
        }

        /* CONTAINER */
        .container {
            height: calc(100vh - 100px);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* CARD */
        .card {
            width: 400px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            background: white;
        }

        /* HEADER */
        .card-header {
            background: #0f766e;
            color: white;
            padding: 20px;
        }

        .card-header h2 {
            margin: 0;
        }

        /* BODY */
        .card-body {
            padding: 20px;
        }

        label {
            font-weight: 600;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 10px;
            border: 1px solid #ccc;
            background: #e5e7eb;
        }

        button {
            background: orange;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            float: right;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="topbar">
    <div>Dusun Pasinan Timur, Singojuruh, Banyuwangi</div>
    <div>+62 821 4518 2975</div>
</div>

<div class="navbar">
    PAUD Raudhatul Ilmi
</div>

<div class="container">
    <div class="card">

        <div class="card-header">
            <h2>Login Admin</h2>
            <small>Masuk untuk mengelola data guru, siswa, dan rekap absensi.</small>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

               <label>NPSN</label>
               <input type="text" name="npsn" value="{{ old('npsn') }}" required placeholder="Masukkan npsn">

                <label>Password</label>
                <input type="password" name="password" required placeholder="Masukkan password">

                <button type="submit">Login</button>
            </form>

        </div>
    </div>
</div>

</body>
</html>
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<link rel="stylesheet" href="{{ asset('css/auth-custom.css') }}">