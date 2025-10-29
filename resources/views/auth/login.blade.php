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
      <div class="right-column  relative">
        <div class="inner-content h-full flex flex-col bg-white dark:bg-slate-800">
          <div class="auth-box h-full flex flex-col justify-center">
            <div class="mobile-logo text-center mb-6 lg:hidden block">
              <a href="{{ url('/') }}">
                <img src="{{ asset('backend/images/logo/Unxplord-Saudi.png') }}" alt="" class="mb-10 dark_logo w-16 h-16">
                <img src="{{ asset('backend/images/logo/Unxplord-Saudi.png') }}" alt="" class="mb-10 white_logo w-16 h-16">
              </a>
            </div>
            <div class="text-center 2xl:mb-10 mb-4">
              <h4 class="font-medium">{{ __('Login') }}</h4>
              <div class="text-slate-500 text-base">
                Sign in to your account to start using Unexplore
              </div>
            </div>
            <!-- BEGIN: Login Form -->

            <form id="lang-form" action="" method="get">
              <select onchange="window.location.href=this.value;">
                  <option value="{{ route('lang.switch', 'en') }}" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                  <option value="{{ route('lang.switch', 'de') }}" {{ app()->getLocale() == 'de' ? 'selected' : '' }}>Deutsch</option>
                  <option value="{{ route('lang.switch', 'ar') }}" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>العربية</option>
              </select>
          </form>

            <form class="space-y-4" method="POST" action="{{ route('login') }}" >
            @csrf
              <div class="fromGroup">
                <label class="block capitalize form-label">email</label>
                <div class="relative ">
                  <input type="email" name="email" class="  form-control py-2" placeholder="email" >
                </div>
              </div>
              <div class="fromGroup       ">
                <label class="block capitalize form-label  ">passwrod</label>
                <div class="relative "><input type="password" name="password" class="  form-control py-2   " placeholder="password" >
                </div>
              </div>
              <div class="flex justify-between">
              <label class="flex items-center cursor-pointer"> <input type="checkbox" class="pr-3" id="checkbox"> <span class="pl-2 text-slate-500 dark:text-slate-400 text-sm leading-6 capitalize">Keep me signed in</span></label>
                <a class="text-sm text-slate-800 dark:text-slate-400 leading-6 font-medium" href="{{ url('/forgot-password') }}">Forgot
                  Password?
                </a>
              </div>
              <button type="submit" class="btn btn-dark block w-full text-center">Sign in</button>
            </form>

            @if($errors->any()) <div>{{ $errors->first() }}</div> @endif
            <!-- END: Login Form -->
            <!-- <div class="relative border-b-[#9AA2AF] border-opacity-[16%] border-b pt-6">
              <div class="absolute inline-block bg-white dark:bg-slate-800 dark:text-slate-400 left-1/2 top-1/2 transform -translate-x-1/2
                                    px-4 min-w-max text-sm text-slate-500 font-normal">
                Or continue with
              </div>
            </div> -->
            <!-- <div class="max-w-[242px] mx-auto mt-8 w-full"> -->

              <!-- BEGIN: Social Log in Area -->
              <!-- <ul class="flex">
                <li class="flex-1">
                  <a href="#" class="inline-flex h-10 w-10 bg-[#1C9CEB] text-white text-2xl flex-col items-center justify-center rounded-full">
                    <img src="backend/images/icon/tw.svg" alt="">
                  </a>
                </li>
                <li class="flex-1">
                  <a href="#" class="inline-flex h-10 w-10 bg-[#395599] text-white text-2xl flex-col items-center justify-center rounded-full">
                    <img src="backend/images/icon/fb.svg" alt="">
                  </a>
                </li>
                <li class="flex-1">
                  <a href="#" class="inline-flex h-10 w-10 bg-[#0A63BC] text-white text-2xl flex-col items-center justify-center rounded-full">
                    <img src="backend/images/icon/in.svg" alt="">
                  </a>
                </li>
                <li class="flex-1">
                  <a href="#" class="inline-flex h-10 w-10 bg-[#EA4335] text-white text-2xl flex-col items-center justify-center rounded-full">
                    <img src="backend/images/icon/gp.svg" alt="">
                  </a>
                </li>
              </ul> -->
              <!-- END: Social Log In Area -->
            <!-- </div> -->
            <div class="md:max-w-[345px] mx-auto font-normal text-slate-500 dark:text-slate-400 mt-12 uppercase text-sm">
              Don’t have an account?
              <a href="{{ url('/register')}}" class="text-slate-900 dark:text-white font-medium hover:underline">
                Sign up
              </a>
            </div>
          </div>
          <div class="auth-footer text-center">
            Copyright 2025, Unexplord Saudi All Rights Reserved.
          </div>
        </div>
      </div>
    </div>
  </div>

  @endsection