<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">

    <title>{{ config('app.name', 'Admin | Qwikkar') }}</title>

    <!-- Styles -->
    <link href="http://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="{{ mix('css/noty.css') }}" rel="stylesheet">

    <link href="{{ mix('css/admin.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script type="text/javascript">
        window.Qwikkar = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    @yield('page-styles')

</head>
<body class="fix-sidebar">
    <div id="wrapper">
        <!-- .header -->
        @include('admin.layouts.header')
        <!-- /.header -->

        <!-- .left-sidebar -->
        @include('admin.layouts.left-sidebar')
        <!-- /.left-sidebar -->

        <div id="page-wrapper">
            <!-- .container-fluid -->
            <div class="container-fluid">
                <!-- .breadcrumb -->
                @include('admin.layouts.breadcrumb')
                <!-- /.breadcrumb -->

                @yield('content')

                <!-- .right-sidebar -->
                @include('admin.layouts.right-sidebar')
                <!-- /.right-sidebar -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy; Qwikkar Admin brought to you by <a href="http://srhives.com" target="_blank">srhives.com</a> </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDp8Pjc5ZmcmTb-ci-Fj-xNh2KLTUlguk0&libraries=places"></script>
    <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/admin.js') }}"></script>

    @yield("page-scripts")

</body>
</html>
