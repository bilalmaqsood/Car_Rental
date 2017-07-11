<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <style type="text/css">
        @font-face {
            font-family: 'Raleway';
            src: url('{!! storage_path('fonts/Raleway-regular/Raleway-regular.ttf') !!}') format('truetype');
        }

        @font-face {
            font-family: 'Raleway Bold';
            src: url('{!! storage_path('fonts/Raleway-700/Raleway-700.ttf') !!}') format('truetype');
        }

        p,
        br {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Raleway;
            line-height: 1.3rem;
        }

        .h1 {
            font-family: 'Raleway Bold';
            font-size: 2em;
        }

        .h1 span {
            font-family: Raleway;
            font-size: 2.4em;
        }
    </style>
</head>
<body>

<p class="h1"><span>Q</span>wikkar</p>
<br>
<br>
<br>

{!! $content !!}

<br>
<br>
<div style="clear: both;"></div>
<div>
    @if(isset($owner_signature) && $owner_signature)
        <img src="{!! storage_path('app/public/'.$owner_signature) !!}" alt="owner signature logo" style="float: left; height: 150px;">
    @endif

    @if(isset($driver_signature) && $driver_signature)
        <img src="{!! storage_path('app/public/'.$driver_signature) !!}" alt="driver signature logo" style="float: left; height: 150px;">
    @endif
    <div style="clear: both;"></div>
</div>
</body>
</html>