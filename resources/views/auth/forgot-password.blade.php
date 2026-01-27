@extends('auth.layout')

@section('title', __('Forgot Password'))

@section('content')
<div class="loginwrapper">
    <div class="lg-inner-column">

        {{-- LEFT IMAGE SECTION (SAME AS LOGIN) --}}
        <div class="left-column relative z-[1]">
            <div class="max-w-[520px] pt-20 ltr:pl-20 rtl:pr-20">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('backend/images/logo/Unxplord-Saudi.png') }}"
                         class="mb-10 dark_logo w-16 h-16">
                    <img src="{{ asset('backend/images/logo/Unxplord-Saudi.png') }}"
                         class="mb-10 white_logo w-16 h-16">
                </a>
            </div>

            <div class="absolute left-0 bottom-[-130px] h-full w-full z-[-1]">
                <img src="{{ asset('backend/images/auth/ils1.svg') }}"
                     class="h-full w-full object-contain"
                     alt="">
            </div>
        </div>

        {{-- RIGHT FORM SECTION --}}
        <div class="right-column relative">
            <div class="inner-content h-full flex flex-col bg-white dark:bg-slate-800">

                <div class="auth-box2 flex flex-col justify-center h-full">

                    {{-- MOBILE LOGO --}}
                    <div class="mobile-logo text-center mb-6 lg:hidden block">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('backend/images/logo/logo.svg') }}" class="mx-auto">
                            <img src="{{ asset('backend/images/logo/logo-white.svg') }}" class="mx-auto">
                        </a>
                    </div>

                    {{-- HEADER --}}
                    <div class="text-center mb-6">
                        <h4 class="font-medium mb-2">
                            Forgot Your Password?
                        </h4>
                        <p class="text-slate-500 dark:text-slate-400">
                            Reset password with Unexplord
                        </p>
                    </div>

                    {{-- INFO BOX --}}
                    <div
                        class="font-normal text-base text-slate-500 dark:text-slate-400 text-center
                        px-4 py-3 rounded bg-slate-100 dark:bg-slate-700 mb-6">
                        Enter your email and we’ll send you a reset link.
                    </div>

                    {{-- SUCCESS MESSAGE --}}
                    @if (session('status'))
                        <div class="text-green-600 text-center mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- FORM --}}
                    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                        @csrf

                        <div class="fromGroup">
                            <label class="form-label">Email</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control py-2"
                                placeholder="Enter your email"
                                required
                                value="{{ old('email') }}">

                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-dark w-full">
                            Send Recovery Email
                        </button>
                    </form>

                    {{-- BACK TO LOGIN --}}
                    <div class="text-center text-sm text-slate-500 mt-8 uppercase">
                        Remember password?
                        <a href="{{ route('login') }}"
                           class="text-slate-900 dark:text-white font-medium hover:underline">
                            Sign In
                        </a>
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="auth-footer text-center">
                    © {{ date('Y') }} Unexplord Saudi. All Rights Reserved.
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
