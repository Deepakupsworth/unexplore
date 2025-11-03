<!DOCTYPE html>
<!-- Template Name: DashCode - HTML, React, Vue, Tailwind Admin Dashboard Template Author: Codeshaper Website: https://codeshaper.net Contact: support@codeshaperbd.net Like: https://www.facebook.com/Codeshaperbd Purchase: https://themeforest.net/item/dashcode-admin-dashboard-template/42600453 License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project. -->
<html lang="zxx" dir="ltr" class="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <title>Unxplord saudi - Backend</title>
  <link rel="icon" type="image/png" href="/images/logo/favicon.svg">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- BEGIN: Theme CSS-->
  <link rel="stylesheet" href="{{ asset('backend/css/rt-plugins.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/css/app.css') }}">
  <!-- End : Theme CSS-->
  <script src="{{ asset('backend/js/settings.js') }}" sync></script>
  <style>.dataTables_paginate{display:none;}</style>
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

@yield('scripts') 

  <!-- Footer End -->
  <!-- scripts -->
  <script src="{{ asset('backend/js/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('backend/js/rt-plugins.js') }}"></script>
  <script src="{{ asset('backend/js/app.js') }}"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('textarea').forEach((textarea) => {
            ClassicEditor
                .create(textarea, {
                    toolbar: [
                        'heading', '|',
                        'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                        'blockQuote', 'insertTable', 'undo', 'redo'
                    ],
                    heading: {
                        options: [
                            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                            { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                        ]
                    }
                })
                .then(editor => {
                    console.log('CKEditor initialized for:', textarea.name);
                })
                .catch(error => {
                    console.error('CKEditor initialization error:', error);
                });
        });
    });
</script>
</body>
</html>