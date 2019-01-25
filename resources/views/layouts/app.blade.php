<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
            crossorigin="anonymous">
        <title>Planea tu bien</title>
    </head>
    <body>
        <div class="row">
            <div class="col-12 p-0 m-0">
                <a href="/">
                    <img src="{{asset(  'img/header.jpg')}}" class="img-fluid" alt="Sigvaris.">
                </a>
            </div>
        </div>
        <div class="row m-0 p-0">
            <div class="col-12 m-0 p-0">
                <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #081170;">
                    <a class="navbar-brand" href="/">
                        <strong>Planea tu bien</strong>
                    </a>
                </nav>
            </div>
        </div>
        <div class="container py-5">
            @yield('content')
        </div>
    </body>
</html>
