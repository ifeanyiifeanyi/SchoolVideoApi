<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }} :: @yield('title')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <!-- Toastr -->

  @yield('css')
  <style>
    .slider.round {
      border-radius: 34px;
    }

    .slider {
      background-color: #ccc;
      bottom: 0;
      cursor: pointer;
      left: 0;
      position: absolute;
      right: 0;
      top: 0;
      transition: 400ms;
    }

    label:not(.form-check-label):not(.custom-file-label) {
      font-weight: 700;
    }

    link:hover {
      color: rgba(0, 0, 0, .7);
    }

    .nav-link:focus,
    .nav-link:hover {
      text-decoration: none;
    }

    .slider.round::before {
      border-radius: 50%;
    }

    .slider::before {
      background-color: #fff;
      bottom: 4px;
      content: "";
      height: 16px;
      left: 4px;
      position: absolute;
      transition: 400ms;
      width: 16px;
    }
  </style>
    <link rel="stylesheet" href="{{ asset('admin/plugins/toastr/toastr.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    @include('admin.layouts.adminNavbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('admin.layouts.adminSidebar')

    <!-- Content Wrapper. Contains page content -->
    @yield('adminContent')
    <!-- /.content-wrapper -->



    <!-- Main Footer -->
    @include('admin.layouts.adminFooter')
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>

  <script>
    @if (Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch (type) {
      case 'info':
        toastr.info("{{ Session::get('message') }}");
        break;
      case 'success':
        toastr.success("{{ Session::get('message') }}");
        break;
      case 'warning':
        toastr.warning("{{ Session::get('message') }}");
        break;
      case 'error':
        toastr.error("{{ Session::get('message') }}");
        break;

      default:
        break;
    }

  @endif
  </script>
  <script>
    var toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
    var currentTheme = localStorage.getItem('theme');
    var mainHeader = document.querySelector('.main-header');
  
    if (currentTheme) {
      if (currentTheme === 'dark') {
        if (!document.body.classList.contains('dark-mode')) {
          document.body.classList.add("dark-mode");
        }
        if (mainHeader.classList.contains('navbar-light')) {
          mainHeader.classList.add('navbar-dark');
          mainHeader.classList.remove('navbar-light');
        }
        toggleSwitch.checked = true;
      }
    }
  
    function switchTheme(e) {
      if (e.target.checked) {
        if (!document.body.classList.contains('dark-mode')) {
          document.body.classList.add("dark-mode");
        }
        if (mainHeader.classList.contains('navbar-light')) {
          mainHeader.classList.add('navbar-dark');
          mainHeader.classList.remove('navbar-light');
        }
        localStorage.setItem('theme', 'dark');
      } else {
        if (document.body.classList.contains('dark-mode')) {
          document.body.classList.remove("dark-mode");
        }
        if (mainHeader.classList.contains('navbar-dark')) {
          mainHeader.classList.add('navbar-light');
          mainHeader.classList.remove('navbar-dark');
        }
        localStorage.setItem('theme', 'light');
      }
    }
  
    toggleSwitch.addEventListener('change', switchTheme, false);
  </script>
  @yield('js')

</body>

</html>