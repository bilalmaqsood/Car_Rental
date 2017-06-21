<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Qwikkar') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/qwikkar.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script type="text/javascript">
        window.Qwikkar = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <div class="nav_wrapper">
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">
                        <img src="/images/white_logo.png" alt="" class="default_logo"/>
                        <img src="/images/logo.png" alt="" class="hover_logo"/>
                    </a>
                </div>
                <div id="navbar" class="customize_nav">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#cog_setting"></use>
                                </svg>
                                about us
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 20" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#chat"></use>
                                </svg>
                                contact us
                            </a>
                        </li>
                        <li class="active">
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                                </svg>
                                Login
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        @yield('content')

        <div class="footer_wrapper">
            <p>Copyright 2017 @ qwikkar ltd. All rights reserved</p>
        </div>
    </div>

    @include('layouts.svgs')

    <!-- Scripts -->
    <script src="{{ mix('js/jst.js') }}"></script>
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/qwikkar.js') }}"></script>
</body>
</html>