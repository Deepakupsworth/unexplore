@extends('auth.layout')
@section('title', __('auth.reset.title'))
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

                <h1 class="mt-4 fw-600 h5">{{ __('auth.reset.title') }}</h1>
                <p class="text-light2">
                    {{ __('auth.reset.subtitle') }}
                </p>

                <form class="space-y-4" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    {{-- Email --}}
                    <div class="fromGroup mb-4">
                        <label class="form-label">{{ __('auth.reset.email_label') }}</label>
                        <div class="relative">
                            <input type="email" name="email" class="form-control py-2"
                                placeholder="{{ __('auth.reset.email_placeholder') }}" value="{{ request('email') }}"
                                required>
                        </div>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- New Password --}}
                    <div class="fromGroup mb-4">
                        <label class="form-label">{{ __('auth.reset.new_password_label') }}</label>
                        <div class="relative">
                            <input type="password" name="password" class="form-control py-2"
                                placeholder="{{ __('auth.reset.new_password_placeholder') }}" required>
                        </div>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="fromGroup mb-4">
                        <label class="form-label">{{ __('auth.reset.confirm_password_label') }}</label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" class="form-control py-2"
                                placeholder="{{ __('auth.reset.confirm_password_placeholder') }}" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-submit w-100 rounded-pill">
                        {{ __('auth.reset.submit') }}
                    </button>
                </form>

                <p class="text-center mt-3">
                    {{ __('auth.reset.remember_password') }}
                    <a href="{{ route('login') }}" class="text-decoration-none primary-text fw-500">
                        {{ __('auth.reset.sign_in') }}
                    </a>
                </p>

            </div>
        </div>

    </div>

@endsection
