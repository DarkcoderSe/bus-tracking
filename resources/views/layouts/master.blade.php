<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="icon" href="{!! asset('/img/ico.ico.png') !!}"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('pageTitle')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/css/all.min.css')}}">
  <!-- Ionicons -->
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('css/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('css/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('css/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('css/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <style>
    .red{
      color: #ff0000;
    }

  </style>
  @stack('style')
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ URL::to('/home') }} " class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ URL::to('/profile') }} " class="nav-link">Profile</a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ URL::to('/#contact') }} " class="nav-link">test</a>
      </li> -->
      <li class="nav-item d-none d-sm-inline-block">
          <a class="nav-link"  href="{{ route('logout') }}"
             onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
      </li>
 
    </ul>

    <!-- SEARCH FORM -->
 

    <!-- Right navbar links -->

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://i.pinimg.com/originals/b1/bb/ec/b1bbec499a0d66e5403480e8cda1bcbe.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ URL::to('/home') }} " class="d-block">
            {{ Auth::user()->name }}
          </a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any oth er icon font library -->
          <li class="nav-item has-treeview">
            <a href="{{ URL::to('/home') }} " class="nav-link">
       
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ URL::to('/admin/driver') }}" class="nav-link">
         
                <p>
                  Drivers
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ URL::to('/admin/user') }}" class="nav-link">
         
                <p>
                  Users
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ URL::to('/admin/vehicle') }}" class="nav-link">
         
                <p>
                  Vehicle
                </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper pt-4">

    <!-- Main content -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2019 </strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      {{-- <b>Version</b> 1.0 | Developed by <a href="http://darkcoderse.com">Kashif Saleem</a> --}}
    </div>
  </footer>

</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{URL::to('javascripts/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{URL::to('javascripts/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
  
</script>
<script src="{{URL::to('javascripts/adminlte.js')}}"></script>
<script src="{{URL::to('javascripts/demo.js')}}"></script>
@stack('script')
{!! Toastr::message() !!}
</body>
</html>