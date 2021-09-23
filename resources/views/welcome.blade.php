<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <script>window.laravel - {csrftoken: '{{csrf_token()}}'}</script>
        <title>Laravel - Vue API</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="{{asset('css/app.css')}}" rel="stylesheet">

    </head>
    <body>
        <div id="app">
            <navbar></navbar>
            <customers></customers>
        </div>
       <script type="text/javascript" src="{{mix('js/app.js')}}"></script>
    </body>
</html>
