<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Swippy')</title>
  <link rel="icon" href="{{ asset('assets/images/icons/favicon.ico') }}" type="image/x-icon">

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="{{ asset('assets/front/css/style.css') }}" rel="stylesheet">
  <!--Page-specific CSS -->
    @yield('css')
</head>
<body>
    <body class="d-flex flex-column min-vh-100">

        {{-- Header --}}
        @include('front.layouts.partials.header')

        {{-- Main content --}}
        <main class="flex-fill">
          @yield('content')
        </main>

        {{-- Footer --}}
        @include('front.layouts.partials.footer')

    <!-- jQuery first, then Slick, then your custom scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('assets/front/js/script.js') }}"></script>
    <!--Page-specific js -->
    @yield('js')
  </body>
  </html>
