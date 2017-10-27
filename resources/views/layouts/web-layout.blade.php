<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">

    <title>{{ config('app.name', 'Qwikkar') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ mix('css/qwikkar.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script type="text/javascript">
        window.Qwikkar = {!! json_encode([
            'csrfToken' => csrf_token(),
            'baseUrl' => url('/'),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <app-header tot_vehicles='{{$tot_vehicles}}'></app-header>
        <chats ref="chats"></chats>
        @yield('content')
    </div>

    @include('layouts.svgs')

    <!-- Scripts -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDp8Pjc5ZmcmTb-ci-Fj-xNh2KLTUlguk0&libraries=places"></script>
    <script src="//{{ Request::getHost() }}:7940/socket.io/socket.io.js"></script>
    {{--<script src="{{ asset('js/socket.io.js') }}"></script>--}}
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/qwikkar.js') }}"></script>

    <script>
        localStorage.removeItem('__' + Qwikkar.baseUrl + '/search/vehicle-titles__data');

        function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            console.log("User denied the request for Geolocation.")
            break;
        case error.POSITION_UNAVAILABLE:
            console.log("Location information is unavailable.")
            break;
        case error.TIMEOUT:
            console.log("The request to get user location timed out.")
            break;
        case error.UNKNOWN_ERROR:
            console.log("An unknown error occurred.")
            break;
    }
}

        function showPosition(position) {
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    window.lat = lat;
    window.lng = lng;
}
        $(document).ready(function() {
             if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition, showError);
                  } else {
                    console.log("Your browser does not support Geolocation!");
                  }
        });


    </script>
</body>
</html>