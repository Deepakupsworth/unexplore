<!-- <!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>

    @if (session('status'))
        <div style="color: green;">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <input type="email" name="email" placeholder="Email" value="{{ request('email') }}" required>
        @error('email') <div style="color: red;">{{ $message }}</div> @enderror

        <input type="password" name="password" placeholder="New Password" required>
        @error('password') <div style="color: red;">{{ $message }}</div> @enderror

        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

        <button type="submit">Reset Password</button>
    </form>

    <p><a href="{{ route('login') }}">Back to Login</a></p>
</body>
</html> -->


@extends('backend.signinlayout')
@section('title', 'Dashboard')
@section('content')

<div class="loginwrapper">
    <div class="lg-inner-column">
      <div class="left-column relative z-[1]">
        <div class="max-w-[520px] pt-20 ltr:pl-20 rtl:pr-20">
          <a href="{{ url('/') }}">
            <img src="{{ asset('backend/images/logo/Unxplord-Saudi.png') }}" alt="" class="mb-10 dark_logo">
            <img src="{{ asset('backend/images/logo/Unxplord-Saudi.png') }}" alt="" class="mb-10 white_logo">
          </a>
          <h4>
            Unlock your Project
            <span class="text-slate-800 dark:text-slate-400 font-bold">
                            performance
                        </span>
          </h4>
        </div>
        <div class="absolute left-0 2xl:bottom-[-160px] bottom-[-130px] h-full w-full z-[-1]">
          <img src="/backend/images/auth/ils1.svg" alt="" class=" h-full w-full object-contain">
        </div>
      </div>
      <div class="right-column  relative">
        <div class="inner-content h-full flex flex-col bg-white dark:bg-slate-800">
          <div class="auth-box h-full flex flex-col justify-center">
            <div class="mobile-logo text-center mb-6 lg:hidden block">
              <a href="{{ url('/admin/dashboard') }}">
                <img src="{{ asset('backend/images/logo/Unxplord-Saudi.png') }}" alt="" class="mb-10 dark_logo">
                <img src="{{ asset('backend/images/logo/Unxplord-Saudi.png') }}" alt="" class="mb-10 white_logo">
              </a>
            </div>
            <div class="text-center 2xl:mb-10 mb-4">
              <h4 class="font-medium">Sign in</h4>
              <div class="text-slate-500 text-base">
                Sign in to your account to start using Unexplore
              </div>
            </div>
            <!-- BEGIN: Login Form -->
            @if (session('status'))
                <div style="color: green;">{{ session('status') }}</div>
            @endif

            <form class="space-y-4" method="POST" action="{{ route('password.update') }}" >
            @csrf
             <input type="hidden" name="token" value="{{ $token }}">
              <div class="fromGroup">
                <label class="block capitalize form-label">email</label>
                <div class="relative ">
                  <input type="email" name="email" class="form-control py-2" placeholder="email" value="{{ request('email') }}">
                </div>
                @error('email') <div style="color: red;">{{ $message }}</div> @enderror
              </div>

              <div class="fromGroup">
                <label class="block capitalize form-label  ">passwrod</label>
                <div class="relative "><input type="password" name="password" class="  form-control py-2   " placeholder="password" >
                </div>
                @error('password') <div style="color: red;">{{ $message }}</div> @enderror
              </div>

              <div class="fromGroup">
                <label class="block capitalize form-label  ">confirm password</label>
                <div class="relative "><input type="password" name="password_confirmation" class="  form-control py-2   " placeholder="confirm password" >
                </div>
                @error('password') <div style="color: red;">{{ $message }}</div> @enderror
              </div>

              <button type="submit" class="btn btn-dark block w-full text-center">Reset Password</button>
            </form>
            <!-- END: Login Form -->
            <div class="relative border-b-[#9AA2AF] border-opacity-[16%] border-b pt-6">
              <div class="absolute inline-block bg-white dark:bg-slate-800 dark:text-slate-400 left-1/2 top-1/2 transform -translate-x-1/2
                                    px-4 min-w-max text-sm text-slate-500 font-normal">
                Or continue with
              </div>
            </div>
            <div class="max-w-[242px] mx-auto mt-8 w-full">

              <!-- BEGIN: Social Log in Area -->
              <ul class="flex">
                <li class="flex-1">
                  <a href="#" class="inline-flex h-10 w-10 bg-[#1C9CEB] text-white text-2xl flex-col items-center justify-center rounded-full">
                    <img src="/backend/images/icon/tw.svg" alt="">
                  </a>
                </li>
                <li class="flex-1">
                  <a href="#" class="inline-flex h-10 w-10 bg-[#395599] text-white text-2xl flex-col items-center justify-center rounded-full">
                    <img src="/backend/images/icon/fb.svg" alt="">
                  </a>
                </li>
                <li class="flex-1">
                  <a href="#" class="inline-flex h-10 w-10 bg-[#0A63BC] text-white text-2xl flex-col items-center justify-center rounded-full">
                    <img src="/backend/images/icon/in.svg" alt="">
                  </a>
                </li>
                <li class="flex-1">
                  <a href="#" class="inline-flex h-10 w-10 bg-[#EA4335] text-white text-2xl flex-col items-center justify-center rounded-full">
                    <img src="/backend/images/icon/gp.svg" alt="">
                  </a>
                </li>
              </ul>
              <!-- END: Social Log In Area -->
            </div>
            <div class="md:max-w-[345px] mx-auto font-normal text-slate-500 dark:text-slate-400 mt-12 uppercase text-sm">
                  
            <a href="{{ url('/login')}}" class="text-slate-900 dark:text-white font-medium hover:underline">
              Back to Login
              </a>
            </div>
          </div>
          <div class="auth-footer text-center">
            Copyright 2021, Dashcode All Rights Reserved.
          </div>
        </div>
      </div>
    </div>
  </div>

  @endsection