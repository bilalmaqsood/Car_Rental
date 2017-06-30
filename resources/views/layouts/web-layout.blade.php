<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{!! url("/favicon-32x32.png") !!}" sizes="32x32">
    <link rel="icon" type="image/png" href="{!! url("/favicon-16x16.png") !!}" sizes="16x16">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Qwikkar') }}</title>

    <!-- Styles -->
    <link href="{{ url(mix('css/qwikkar.css')) }}" rel="stylesheet">

    <!-- Scripts -->
    <script type="text/javascript">
        window.Qwikkar = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <app-header></app-header>

        @yield('content')

        <div class="footer_wrapper">
            <p>Copyright 2017 @ qwikkar ltd. All rights reserved</p>
        </div>
    </div>

    @include('layouts.svgs')

    <!-- Scripts -->
    <script src="{{ url(mix('js/jst.js')) }}"></script>
    <script src="{{ url(mix('js/manifest.js')) }}"></script>
    <script src="{{ url(mix('js/vendor.js')) }}"></script>
    <script src="{{ url(mix('js/qwikkar.js')) }}"></script>
</body>
</html>