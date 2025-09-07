@extends('layouts.app')

@section('content')
<div class="container py-5">
    {{-- Header --}}
    <div class="mb-4 text-center">
        <h1 class="h3 fw-light mb-1">My Profile</h1>
        <p class="text-muted small">Manage your account information and settings</p>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <div><strong>{{ session('success') }}</strong></div>
        </div>
    @endif

    {{-- Form Card --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Section: Profile Information --}}
                <div class="mb-4 border-bottom pb-2">
                    <h2 class="h6 mb-1">Profile Information</h2>
                    <p class="text-muted small mb-0">Update your basic account information</p>
                </div>

                <div class="row g-3">
                    {{-- Name --}}
                    <div class="col-md-6">
                        <label for="name" class="form-label">
                            Full Name <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name', $user->name) }}"
                            placeholder="Enter your full name"
                            class="form-control @error('name') is-invalid @enderror"
                        >
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6">
                        <label for="email" class="form-label">
                            Email Address <span class="text-danger">*</span>
                        </label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email', $user->email) }}"
                            placeholder="Enter your email address"
                            class="form-control @error('email') is-invalid @enderror"
                        >
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Account Details --}}
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label class="form-label">Member Since</label>
                        <input type="text" class="form-control" value="{{ $user->created_at->format('F j, Y') }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Account Role</label>
                        <input type="text" class="form-control" value="{{ ucfirst($user->role ?? 'User') }}" readonly>
                    </div>
                </div>

                {{-- Section: Change Password --}}
                <div class="mt-4 mb-2 border-bottom pb-2">
                    <h2 class="h6 mb-1">Change Password</h2>
                    <p class="text-muted small mb-0">Leave blank if you don't want to change your password</p>
                </div>

                <div class="row g-3">
                    {{-- Current Password --}}
                    <div class="col-md-4">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input
                            type="password"
                            name="current_password"
                            id="current_password"
                            placeholder="Enter current password"
                            class="form-control @error('current_password') is-invalid @enderror"
                        >
                        @error('current_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- New Password --}}
                    <div class="col-md-4">
                        <label for="password" class="form-label">New Password</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Enter new password"
                            class="form-control @error('password') is-invalid @enderror"
                        >
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="col-md-4">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            placeholder="Confirm new password"
                            class="form-control"
                        >
                    </div>
                </div>

                {{-- Footer --}}
                <div class="d-flex align-items-center justify-content-between mt-4 pt-3 border-top">
                    <div class="small text-muted">
                        <span class="text-danger">*</span> Required fields
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('welcome') }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-dark">
                            Update Profile
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Profile Statistics --}}
    <div class="row g-3 mt-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-center h-100">
                <div class="card-body">
                    <div class="h4 fw-bold mb-1">{{ $user->posts->count() }}</div>
                    <div class="text-muted small">Blog Posts</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-center h-100">
                <div class="card-body">
                    <div class="h4 fw-bold mb-1">{{ $user->comments->count() }}</div>
                    <div class="text-muted small">Comments Made</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-center h-100">
                <div class="card-body">
                    <div class="h4 fw-bold mb-1">{{ $user->created_at->diffInDays() }}</div>
                    <div class="text-muted small">Days Active</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
