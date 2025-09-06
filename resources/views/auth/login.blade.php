@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      {{-- Flash Messages --}}
      @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="card shadow-sm border-0">
        <div class="card-body p-4">
          <h4 class="text-center mb-2">Login to Your Account</h4>
          <p class="text-center text-muted mb-4">
            Or <a href="{{ route('register') }}">create a new account</a>
          </p>

          <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            {{-- Email --}}
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input
                id="email"
                name="email"
                type="email"
                autocomplete="email"
                required
                class="form-control @error('email') is-invalid @enderror"
                placeholder="Enter your email address"
                value="{{ old('email') }}"
              >
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input
                id="password"
                name="password"
                type="password"
                autocomplete="current-password"
                required
                class="form-control @error('password') is-invalid @enderror"
                placeholder="Enter your password"
              >
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Remember + Forgot --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="remember_me" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember_me">Remember me</label>
              </div>

              @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="small">Forgot your password?</a>
              @endif
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn btn-primary w-100">
              Login
            </button>
          </form>
        </div>
      </div>

      {{-- Papar senarai ralat umum (jika ada) --}}
      @if ($errors->any())
        <div class="alert alert-warning mt-3 mb-0">
          <strong>Attention:</strong> Invalid username/password. Please try again.
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
