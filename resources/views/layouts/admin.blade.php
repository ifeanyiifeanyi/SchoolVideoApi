<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }} :: @yield('title')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/toastr/toastr.min.css') }}">
  <!-- SweetAlert2 -->
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
    @include('layouts.adminNavbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.adminSidebar')

  <!-- Content Wrapper. Contains page content -->
        @yield('adminContent')
  <!-- /.content-wrapper -->



  <!-- Main Footer -->
  @include('layouts.adminFooter')
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

</body>
</html>
