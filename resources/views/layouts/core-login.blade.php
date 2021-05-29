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
        <link href="{{ asset('coreui/icons/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
        <link href="{{ asset('coreui/icons/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('coreui/icons/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">
        <!-- Main Styling -->
        <link href="{{ asset('coreui/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('coreui/vendors/pace-progress/css/pace.min.css') }}" rel="stylesheet">

    </head>

    <body class="app flex-row align-items-center">
      <div class="container">
        @yield('content')
      </div>


    <!-- Plugins -->
    <script type="text/javascript" src="{{ asset('coreui/plugins/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script> <!-- vue -->
    <script type="text/javascript" src="{{ asset('theme/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('coreui/vendors/popper.js/dist/umd/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('coreui/vendors/pace-progress/pace.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('coreui/vendors/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('coreui/icons/coreui/coreui/dist/js/coreui.min.js') }}"></script>
    </body>
</html>