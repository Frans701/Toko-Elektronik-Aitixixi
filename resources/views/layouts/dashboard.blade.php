<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>{{ $title }}</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('js/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
  <script type="text/javascript" src="{{ asset('fancyapps/lib/jquery-1.10.1.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('fancyapps/source/jquery.fancybox.js?v=2.1.5') }}"></script>
  <link rel="stylesheet" type="text/css" href="{{ asset('fancyapps/source/jquery.fancybox.css?v=2.1.5') }}" media="screen">
  <script src="https://www.chartjs.org/dist/2.9.3/Chart.min.js"></script>
  <script src="https://www.chartjs.org/samples/latest/utils.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      setInterval(() => {
        var dt = new Date();
        // $("#autodiv").text(dt.getSeconds());
        $("#lonceng_active").load(location.href + " #lonceng");
        $("#notif_admin_active").load(location.href + " #notif_admin");
      }, 1000);
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function(){
      $(".perbesar").fancybox();
    });
  </script>
  <style>
      .slider-img{
        width: 100%;
        height: 300px;
        object-fit: cover;  
      }

      .test{
        background-color: aqua;
      }

      canvas {
      -moz-user-select: none;
      -webkit-user-select: none;
      -ms-user-select: none;
      }

      .img-box{
        width: 100%;
        height: 300px;
        object-fit: cover; 
      }

      .img-index{
        width: 100px;
        height: 70px;
        object-fit: cover; 
      }
  </style>

  <link rel="stylesheet" type="text/css" href="/css/trix.css">
  <script type="text/javascript" src="/js/trix.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav d-flex justify-content-between w-100">
      <div>
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </div>
      <ul class="navbar-nav  justify-content-end me-sm-4">   
        @php $admin_unRead = App\Models\AdminNotification::where('notifiable_id',Auth::user()->id)->where('read_at', NULL)->orderBy('created_at','desc')->count(); @endphp         
          <li id="test" class="nav-item dropdown d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body font-weight-bold px-0" id="dropdownProfileButton" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="d-none">
                <div id="lonceng">
                  <i class="fa fa-bell me-sm-1"></i>
                  <span class="badge bg-danger">{{$admin_unRead}}</span>
                  <span class="d-sm-inline d-none"></span>
                </div>
              </div>
              <div id="lonceng_active">

              </div>
            </a>
            <ul id="list" class="dropdown-menu dropdown-menu-end px-2 me-sm-n4" aria-labelledby="dropdownProfileButton">
              @php $admin_notifikasi = App\Models\AdminNotification::where('notifiable_id',Auth::user()->id)->where('read_at', NULL)->orderBy('created_at','desc')->get(); @endphp
              @if(!is_null($admin_notifikasi))
                <a class="dropdown-item" href="{{ route('read_all_admin') }}" data-num=""><small>Read all</small></a>
              @endif
              @forelse ($admin_notifikasi as $notifikasi)
              @php $notif = json_decode($notifikasi->data); @endphp
              <div class="d-none">
                <li id="notif_admin">
                    <a href="{{ route('notification', $notifikasi->id) }}" class="dropdown-item btnunNotif" data-num=""><small> [User: {{ $notif->nama }}] {{ $notif->message }}</small></a>
                </li>
              </div>
              <li id="notif_admin_active">
                
              </li>
              @empty
                  <li>
                  <a href="#" class="dropdown-item btnun  Notif" data-num="" >
                      &nbsp;<small>Tidak ada notifikasi</small>
                  </a>
                  </li>
              @endforelse
            </ul>
        </ul>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <li class="brand-link">
      <span class="brand-text font-weight-warning text-danger"><h4><strong>Aitixixi Electronics</strong></h4></span>
    </li>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <li class="d-block text-dark">{{Auth::User()->admin_name}}</li>
        </div>
      </div>

      <!-- Sidebar Menu -->
      @include('layouts.menudashboard')
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ $title }}</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      @yield('content')
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Tugas Besar
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021 <a class="text-warning" href="#">Pemrograman Internet</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('js/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}"></script>
<!--Sweet Alert-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

@yield('script')


</body>
</html>