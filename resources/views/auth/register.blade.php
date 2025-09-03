@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">

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
          <h4 class="text-center mb-2">Daftar Akun Baru</h4>
          <p class="text-center text-muted mb-4">
            Atau <a href="{{ route('login') }}">masuk ke akun yang sudah ada</a>
          </p>

          <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            {{-- Name --}}
            <div class="mb-3">
              <label for="name" class="form-label">Nama Lengkap</label>
              <input id="name" name="name" type="text"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" required autofocus>
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
              <label for="email" class="form-label">Alamat Email</label>
              <input id="email" name="email" type="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" required>
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
              <label for="password" class="form-label">Kata Laluan</label>
              <input id="password" name="password" type="password"
                class="form-control @error('password') is-invalid @enderror"
                required>
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-3">
              <label for="password_confirmation" class="form-label">Konfirmasi Kata Laluan</label>
              <input id="password_confirmation" name="password_confirmation" type="password"
                class="form-control @error('password_confirmation') is-invalid @enderror"
                required>
              @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Terms --}}
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" id="terms" name="terms" required>
              <label class="form-check-label" for="terms">
                Saya setuju dengan
                <a href="#">Syarat dan Ketentuan</a> &
                <a href="#">Kebijakan Privasi</a>
              </label>
              @error('terms')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn btn-primary w-100">
              Daftar Akun
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
