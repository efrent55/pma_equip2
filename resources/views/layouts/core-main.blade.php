<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="PMA Domain Project - unified systems" />
        <meta name="author" content="irishangelrubillos@gmail.com 09189123963" />
        <meta name="csrf-token" value="{{ csrf_token() }}">

        <title>Domain | @yield('title')</title>
        <link rel="shortcut icon" href="{{ asset('coreui/img/seal-logo1.png') }}">

        <!-- Icons-->
        <link href="{{ asset('coreui/icons/coreui/icons/css/coreui-icons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('coreui/icons/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('coreui/icons/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">
        <!-- Main Styling -->
        <link href="{{ asset('coreui/css/style.css') }}" rel="stylesheet">
        <script src="{{ asset('js/jquery.min.js') }}"></script>

        @yield('styles')
    </head>

    <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show brand-minimized sidebar-minimized small">
      <header class="app-header navbar">
        <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{ url('/home') }}">
          <img class="navbar-brand-full" src="{{URL::asset('/coreui/img/logo.jpg')}}" width="89" height="25" alt="PMAIMS">
          <img class="navbar-brand-minimized" src="{{URL::asset('/coreui/img/seal-logo1.png')}}" width="30" height="30" alt="PMAIMS">
        </a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
          <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav navbar-nav ml-auto">
          {{-- <li class="nav-item d-md-down-none">
            <a class="nav-link" href="#">
              <i class="icon-bell"></i>
              <span class="badge badge-pill badge-danger">5</span>
            </a>
          </li> --}}
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              <img class="img-avatar" src="{{ asset('coreui/img/user-icon-png.png') }}"> {{-- {{ Auth::user()->username }} --}}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-header text-center">
                <strong>{{ Auth::user()->username }}</strong>
              </div>
              <a class="dropdown-item" href="#">
                <i class="fa fa-envelope-o"></i> Messages
                <span class="badge badge-success">42</span>
              </a>
              <a class="dropdown-item" href="#">
                <i class="fa fa-user"></i> Profile</a>
              <a class="dropdown-item" href="#">
                <i class="fa fa-wrench"></i> Settings</a>
              @guest
              @else
              <a class="dropdown-item"  href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i class="fa fa-lock text-danger"></i> Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              @endguest
            </div>
          </li>
        </ul>
      </header>

      <div class="app-body">

        @include('_includes.nav.main')

        <main class="main">
          <!-- Breadcrumb -->
            @yield('breadcrumb')
          <!-- Breadcrumb -->

          <!-- Contents -->
          <div class="container-fluid">
            {{-- <div id="ui-view"> --}}
              <div class="animated fadeIn">
                <div id="app">
                    @yield('content')
                </div>
              </div>
            {{-- </div> --}}
          </div>
          <!-- Contents -->

        </main>
      </div>

    <!-- Plugins -->
    <script type="text/javascript" src="{{ asset('coreui/plugins/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script> <!-- vue -->
    <script type="text/javascript" src="{{ asset('coreui/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('coreui/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('coreui/vendors/popper.js/dist/umd/popper.min.js') }}"></script> --}}
    {{-- <script type="text/javascript" src="{{ asset('coreui/plugins/pace-progress/pace.min.js') }}"></script> --}}
    {{-- <script type="text/javascript" src="{{ asset('coreui/vendors/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('coreui/icons/coreui/coreui/dist/js/coreui.min.js') }}"></script>

    {{-- <script>
      $('#ui-view').ajaxLoad();
        $(document).ajaxComplete(function() {
          Pace.restart()
        });
    </script> --}}

    @yield('scripts')
    </body>
</html>