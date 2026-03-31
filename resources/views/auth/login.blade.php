<x-guest-layout>

<style>
/* BACKGROUND */
body {
    background-color: #bfbfbf;
    font-family: 'Segoe UI', sans-serif;
}

/* TOPBAR */
.topbar {
    background-color: #0e8a78;
    color: white;
    font-size: 13px;
    padding: 8px 30px;
    display: flex;
    justify-content: space-between;
}

/* HEADER */
.header {
    background-color: #dcdcdc;
    padding: 15px 30px;
}

.header h4 {
    color: #0e8a78;
    font-weight: bold;
    margin: 0;
}

/* CARD */
.auth-card {
    width: 400px;
    margin: 80px auto;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 12px rgba(0,0,0,0.2);
}

/* HEAD */
.auth-head {
    background-color: #0e8a78;
    color: white;
    padding: 15px;
}

/* BODY */
.auth-body {
    background-color: #e6e6e6;
    padding: 20px;
}

/* INPUT */
.input {
    width: 100%;
    height: 40px;
    border-radius: 10px;
    border: none;
    background-color: #b7c3d0;
    padding: 10px;
}

/* LABEL */
.label {
    font-size: 13px;
    margin-bottom: 5px;
    display: block;
}

/* BUTTON */
.btn-primary {
    background-color: #d4942a;
    border: none;
    border-radius: 20px;
    padding: 8px 25px;
}

.btn-primary:hover {
    background-color: #c17f20;
}

/* ERROR */
.auth-error {
    background: #ffdddd;
    padding: 8px;
    border-radius: 8px;
    margin-bottom: 10px;
    font-size: 12px;
}
</style>

<!-- TOPBAR -->
<div class="topbar">
    <div>Dusun Pasinan Timur, Singojuruh, Banyuwangi</div>
    <div>kbroulotulilmisinoguruh@gmail.com</div>
    <div>+62 821 4518 2975</div>
</div>

<!-- HEADER -->
<div class="header">
    <h4>PAUD Raudhatul Ilmi</h4>
</div>

<!-- ORIGINAL CODE (TIDAK DIUBAH) -->
<div class="auth-card">
  <div class="auth-head">
    <h1>Login Sistem</h1>
    <p>Masuk sebagai admin.</p>
  </div>

  <div class="auth-body">
    @if ($errors->any())
      <div class="auth-error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login.post') }}" class="auth-form">
      @csrf

      <div class="field">
        <label class="label" for="npsn">NPSN</label>
        <input id="npsn"
               class="input"
               type="text"
               name="npsn"
               value="{{ old('npsn') }}"
               required
               autofocus
               placeholder="Masukkan NPSN">
      </div>

      <div class="field" style="margin-top:10px;">
        <label class="label" for="password">Password</label>
        <input id="password"
               class="input"
               type="password"
               name="password"
               required
               placeholder="Masukkan password">
      </div>

      <div class="auth-footer" style="margin-top:15px;text-align:right;">
        <div></div>
        <button type="submit" class="btn btn-primary">
          Login
        </button>
      </div>
    </form>
  </div>
</div>

</x-guest-layout>