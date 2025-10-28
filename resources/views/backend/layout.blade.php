<!DOCTYPE html>
<!-- Template Name: DashCode - HTML, React, Vue, Tailwind Admin Dashboard Template Author: Codeshaper Website: https://codeshaper.net Contact: support@codeshaperbd.net Like: https://www.facebook.com/Codeshaperbd Purchase: https://themeforest.net/item/dashcode-admin-dashboard-template/42600453 License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project. -->
<html lang="zxx" dir="ltr" class="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <title>Dashcode - HTML Template</title>
  <link rel="icon" type="image/png" href="/images/logo/favicon.svg">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- BEGIN: Theme CSS-->
  <link rel="stylesheet" href="{{ asset('backend/css/rt-plugins.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/css/app.css') }}">
  <!-- End : Theme CSS-->
  <script src="{{ asset('backend/js/settings.js') }}" sync></script>
</head>

<body class=" font-inter dashcode-app" id="body_class">



<!-- Main Content -->

<!-- [if IE]> <p class="browserupgrade"> You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security. </p> <![endif] -->
    <main class="app-wrapper">
      <!--Sidebar-->
@include('backend.includes.sidebar')

<div class="flex flex-col justify-between min-h-screen">
<div>
<!-- Header -->
@include('backend.includes.header')

<!-- content-->
@yield('content')  
</div>  
<!-- Footer -->
@include('backend.includes.footer')
</div>  
</main>



  <!-- Footer End -->
  <!-- scripts -->
  <script src="{{ asset('backend/js/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('backend/js/rt-plugins.js') }}"></script>
  <script src="{{ asset('backend/js/app.js') }}"></script>
</body>
</html>