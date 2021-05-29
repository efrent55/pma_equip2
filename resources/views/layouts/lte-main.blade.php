<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="PMA Domain Project - unified systems" />
        <meta name="author" content="irishangelrubillos@gmail.com viber:09189123963" />
        <meta name="csrf-token" value="{{ csrf_token() }}">

        <title>Domain | @yield('title')</title>
        <link rel="shortcut icon" href="{{ asset('images/tactics.png') }}">

        <link rel="stylesheet" href="{{ asset('adminlte/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/Ionicons/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css') }}">
        <!-- select2 -->
        <link rel="stylesheet" href="{{ asset('adminlte/select2/dist/css/select2.min.css') }}">

        {{-- <link rel="stylesheet" href="{{ asset('adminlte/morris.js/morris.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/jvectormap/jquery-jvectormap.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/bootstrap-daterangepicker/daterangepicker.css') }}">--}}

        <!-- Google Font -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600,700,300italic,400italic,600italic"> --}}
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed">

        <style>
          .skin-blue .main-header li.user-header,
          .skin-blue .main-header .logo,
          .skin-blue .main-header .navbar {
            background-color: #27343b !important;
          }
          .skin-blue .main-header .navbar .sidebar-toggle:hover{
            background-color: #222d32 !important;
          }
          body {
            font-family: 'Roboto Condensed', sans-serif !important;
          }
        </style>

        @yield('styles')
    </head>

    <body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
      <div class="wrapper">
        <header class="main-header">
          <a href="#" class="logo">
            <span class="logo-mini"><img src="{{URL::asset('/images/tactics.png')}}" alt="pmahq logo" height="40px"></span>
            <span class="logo-lg"><img src="{{URL::asset('/images/tactics.png')}}" alt="pmahq logo" height="40px"></span>
          </a>
          <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
              <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ asset('coreui/img/user-icon-png.png') }}" class="user-image" alt="User Image">
                    <span class="hidden-xs">{{ Auth::user()->username }}</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="user-header">
                      <img src="{{ asset('coreui/img/user-icon-png.png') }}" class="img-circle" alt="User Image">
                      <p>
                        {{ Auth::user()->username }}
                      </p>
                    </li>
                    <li class="user-body">
                      <div class="row">
                        <div class="col-xs-6 text-center">
                          <a href="#">My Profile</a>
                        </div>
                        <div class="col-xs-6 text-center">
                          <a href="#">My Activities</a>
                        </div>
                      </div>
                    </li>
                    <li class="user-footer">
                      <div >
                        @guest
                        @else
                        <a class="btn btn-default btn-flat btn-block" href="{{ route('logout') }}" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();"><i class="fa fa-lock text-danger"></i> Logout</a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                        @endguest
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
        </header>

        @include('_includes.nav.aside')

        <div class="content-wrapper">
          <section class="content-header">
            <h1>@yield('title')</h1>
            @yield('breadcrumb')
          </section>

          <section class="content">
            {{-- <div id="app"> --}}
              @yield('content')
            {{-- </div> --}}
          </section>
        </div>

      </div>

      <!-- plugins -->
      <script type="text/javascript" src="{{ asset('adminlte/jquery/dist/jquery.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('adminlte/jquery-ui/jquery-ui.min.js') }}"></script>
      <script>
        $.widget.bridge('uibutton', $.ui.button);
      </script>
      <script type="text/javascript" src="{{ asset('adminlte/bootstrap/dist/js/bootstrap.min.js') }}"></script>
      {{-- daterange & datepicker --}}
      <script type="text/javascript" src="{{ asset('adminlte/moment/min/moment.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('adminlte/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
      <script type="text/javascript" src="{{ asset('adminlte/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

      <script type="text/javascript" src="{{ asset('adminlte/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('adminlte/fastclick/lib/fastclick.js') }}"></script>
      <script type="text/javascript" src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
      <!-- select2 -->
      <script src="{{ asset('adminlte/select2/dist/js/select2.full.min.js') }}"></script>

      @yield('scripts')
    </body>
</html>