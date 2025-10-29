<!-- <!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>

    @if (session('status'))
        <div style="color: green;">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <input type="email" name="email" placeholder="Enter your email" required>
        @error('email') <div style="color: red;">{{ $message }}</div> @enderror

        <button type="submit">Send Reset Link</button>
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
            <img src="{{ asset('backend/images/logo/Unxplord-Saudi.png') }}" alt="" class="mb-10 dark_logo w-16 h-16">
            <img src="{{ asset('backend/images/logo/Unxplord-Saudi.png') }}" alt="" class="mb-10 white_logo w-16 h-16">
          </a>
          <!-- <h4>
            Unlock your Project
            <span class="text-slate-800 dark:text-slate-400 font-bold">
                            performance
                        </span>
          </h4> -->
        </div>
        <div class="absolute left-0 2xl:bottom-[-160px] bottom-[-130px] h-full w-full z-[-1]">
          <img src="backend/images/auth/ils1.svg" alt="" class=" h-full w-full object-contain">
        </div>
      </div>
      <div class="right-column relative">
        <div class="inner-content h-full flex flex-col bg-white dark:bg-slate-800">
          <div class="auth-box2 flex flex-col justify-center h-full">
            <div class="mobile-logo text-center mb-6 lg:hidden block">
              <a href="{{ url('/') }}">
                <img src="backend/images/logo/logo.svg" alt="" class="mx-auto">
                <img src="backend/images/logo/logo-white.svg" alt="" class="mx-auto">
              </a>
            </div>
            <div class="text-center 2xl:mb-10 mb-5">
              <h4 class="font-medium mb-4">Forgot Your Password?</h4>
              <div class="text-slate-500 dark:text-slate-400 text-base">
                Reset Password with Unexplore.
              </div>
            </div>
            <div class="font-normal text-base text-slate-500 dark:text-slate-400 text-center px-2 bg-slate-100 dark:bg-slate-600 rounded
                                py-3 mb-4 mt-10">
              Enter your Email and instructions will be sent to you!
            </div>
           
            @if (session('status'))
        <div style="color: green;">{{ session('status') }}</div>
      @endif
            <!-- BEGIN: Forgot Password Form -->
            <form  method="POST" action="{{ route('password.email') }}" class="space-y-4" >
            @csrf
              <div class="fromGroup">
                <label class="block capitalize form-label">email</label>
                <div class="relative ">
                  <input type="email" name="email" class="form-control py-2" placeholder="Enter your Email">
                  @error('email') <div style="color: red;">{{ $message }}</div> @enderror
                </div>
              </div>
              <button type="submit" class="btn btn-dark block w-full text-center">Send recovery email</button>
            </form>
            <!-- END: Forgot Password Form -->

            <div class="md:max-w-[345px] mx-auto font-normal text-slate-500 dark:text-slate-400 2xl:mt-12 mt-8 uppercase text-sm">
              Forget It,
              <a href="{{ url('/admin/dashboard') }}" class="text-slate-900 dark:text-white font-medium hover:underline">
                Send me Back
              </a>
              to The Sign In
            </div>
          </div>
          <div class="auth-footer text-center">
            Copyright 2021, Unexplord Saudi All Rights Reserved.
          </div>
        </div>
      </div>
    </div>
  </div>

  @endsection