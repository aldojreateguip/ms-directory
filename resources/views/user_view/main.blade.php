<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Mainboard')</title>

  @yield('css')
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @vite(['resources/js/app.js', 'resources/js/sidebar.js'])
</head>

<body class="sidebar-mini layout-fixed layout-navbar-fixed">
  <!-- <div class="wrapper"> -->
  @include('layout.header')

  @auth
  @include('layout.sidebar')
  <div class="content-wrapper">
    @yield('content')
  </div>
  @endauth
  @guest
  <div class="main-container">
    @yield('content')
  </div>
  @endguest



  @yield('modals')

  @yield('js')
  
</body>

</html>