<x-guest-layout>
<div class="auth-card">
  <div class="auth-head">
    <h1>Login Guru</h1>
    <p>Masuk menggunakan email dan password untuk mengelola data siswa.</p>
  </div>

  <div class="auth-body">
    @if ($errors->any())
      <div class="auth-error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('teacher.login.post') }}" class="auth-form">
      @csrf

      <div class="field">
        <label class="label" for="email">Email</label>
        <input id="email" class="input" type="email" name="email" value="{{ old('email') }}" required placeholder="Masukkan email guru">
      </div>

      <div class="field">
        <label class="label" for="password">Password</label>
        <input id="password" class="input" type="password" name="password" required placeholder="Masukkan password">
      </div>

      <div class="auth-footer">
        <div></div>
        <button type="submit" class="btn btn-primary">Login Guru</button>
      </div>
    </form>
  </div>
</div>
</x-guest-layout>
