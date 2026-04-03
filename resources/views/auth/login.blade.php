<x-guest-layout>

<div class="auth-card">
  <div class="auth-head">
    <h1>Login Admin</h1>
    <p>Masuk untuk mengelola data guru, siswa, dan rekap absensi.</p>
  </div>

  <div class="auth-body">
    @if ($errors->any())
      <div class="auth-error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login.post') }}" class="auth-form">
      @csrf

      <div class="field">
        <label class="label" for="login">NPSN</label>
        <input id="login"
               class="input"
               type="text"
               name="login"
               value="{{ old('login') }}"
               required
               autofocus
               placeholder="Masukkan NPSN">
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