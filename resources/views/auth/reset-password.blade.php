@extends('auth.layout')
@section('title', 'Reset Password')
@section('content')

<div class="auth-wrapper">

    {{-- LEFT SIDE --}}
    <div class="auth-left">
        <a href="{{ url('/') }}" class="btn auth-back-btn rounded-pill">
            <i class="fa-solid fa-arrow-left flex-center"></i> {{ __('Back to Website') }}
        </a>

        <img class="img-fluid" src="{{ asset('frontend/assets/signup-banner.png') }}" alt="Reset Password Banner">

    </div>

    <div class="auth-divider"></div>

    {{-- RIGHT SIDE --}}
    <div class="auth-right">
        <div>
            <img src="{{ asset('/frontend/assets/logo.png') }}" alt="Logo" style="width: 150px;">

            <h1 class="mt-4 fw-600 h5">Reset Your Password</h1>
            <p class="text-light2">
                Enter your registered email and create a new password to regain access.
            </p>

            <form class="space-y-4" method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                {{-- Email --}}
                <div class="fromGroup mb-4">
                    <label class="form-label">Email Address</label>
                    <div class="relative">
                        <input
                            type="email"
                            name="email"
                            class="form-control py-2"
                            placeholder="Enter your email"
                            value="{{ request('email') }}"
                            required
                        >
                    </div>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- New Password --}}
                <div class="fromGroup mb-4">
                    <label class="form-label">New Password</label>
                    <div class="relative">
                        <input
                            type="password"
                            name="password"
                            class="form-control py-2"
                            placeholder="Enter new password"
                            required
                        >
                    </div>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="fromGroup mb-4">
                    <label class="form-label">Confirm Password</label>
                    <div class="relative">
                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control py-2"
                            placeholder="Re-enter new password"
                            required
                        >
                    </div>
                </div>

                <button
                    type="submit"
                    class="btn btn-primary btn-lg btn-submit w-100 rounded-pill">
                    Reset Password
                </button>
            </form>

            <p class="text-center mt-3">
                Remember your password?
                <a href="{{ route('login') }}" class="text-decoration-none primary-text fw-500">
                    Sign In
                </a>
            </p>

        </div>
    </div>

</div>

@endsection
