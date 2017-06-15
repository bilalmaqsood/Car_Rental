<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <title>Generate PDF with DOMPDF</title>
    {{--<link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet" type="text/css">--}}

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

        .b {
            font-family: 'Raleway Bold';
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

<p><span class="b">Date:</span> {{ \Carbon\Carbon::now()->format('m/d/Y') }}</p>

<br>
<br>
<br>

<p><span class="b">Driver Name</span></p>
<p><span class="b">License#</span> 20564649494949</p>
<p><span class="b">PCO#</span> 20564649494949</p>

<br>
<br>
<br>

<p>Dear Owner,</p>

<br>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A adipisci alias aliquid autem consectetur cum cumque dignissimos, eos facilis impedit ipsa iste magnam optio, quas totam vel vitae. Beatae hic laudantium magni mollitia, sapiente vero?</p>

<br>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A adipisci alias aliquid autem consectetur cum cumque dignissimos, eos facilis impedit ipsa iste magnam optio, quas totam vel vitae. Beatae hic laudantium magni mollitia, sapiente vero?</p>

<br>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A adipisci alias aliquid autem consectetur cum cumque dignissimos, eos facilis impedit ipsa iste magnam optio, quas totam vel vitae. Beatae hic laudantium magni mollitia, sapiente vero?</p>

<br>
<br>

<p>Yours sincerely,</p>
<p>Owner Name</p>
<p><img src="{!! public_path('sample-signature.jpg') !!}" alt=""></p>

</body>
</html>