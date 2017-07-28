<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    @if(isset($webView))
        @include('pdf.web-style')
    @else
        @include('pdf.pdf-style')
    @endif
</head>
<body>

<br>
<p class="h1"><span>Q</span>wikkar</p>
<br>
<br>
<br>

{!! $content !!}

<br>
<br>
<div style="clear: both;"></div>
<div>
    @if(isset($driver_signature) && $driver_signature)
        <img src="{!! storage_path('app/public/'.$driver_signature) !!}" alt="driver signature logo" style="float: left; height: 150px;">
    @endif

    @if(isset($owner_signature) && $owner_signature)
        <img src="{!! storage_path('app/public/'.$owner_signature) !!}" alt="owner signature logo" style="float: right; height: 150px;">
    @endif
    <div style="clear: both;"></div>
</div>
</body>
</html>