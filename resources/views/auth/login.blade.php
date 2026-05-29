<x-guest-layout>

<div class="auth-card">
  <div class="auth-head">
    <h1>Login Sistem</h1>
    <p>Masuk sebagai admin, guru, atau orang tua.</p>
  </div>

  <div class="auth-body">
    @if ($errors->any())
      <div class="auth-error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="auth-form">
      @csrf

      <div class="field">
        <label class="label" for="username">Username</label>
        <input id="username"
               class="input"
               type="text"
               name="username"
               value="{{ old('username') }}"
               required
               autofocus
               placeholder="NPSN / Email / NISN">
      </div>

      <div class="field">
        <label class="label" for="password">Password</label>
        <input id="password"
               class="input"
               type="password"
               name="password"
               required
               placeholder="Masukkan password">
      </div>

      <div class="auth-footer">
        <div></div>
        <button type="submit" class="btn btn-primary">
          Login
        </button>
      </div>
    </form>
  </div>
</div>

</x-guest-layout>