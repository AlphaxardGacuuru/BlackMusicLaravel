<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Change address bar color Chrome, Firefox OS and Opera --}}
    <meta name="theme-color" content="#232323" />
    {{-- iOS Safari --}}
    <meta name="apple-mobile-web-app-status-bar-style" content="#232323">
    <meta name="description" content="The best Kenyan Online Music Store" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Black Music') }}</title>

    <!-- Favicon  -->
    <link rel="icon" href="storage/img/musical-note.png">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/style.css') }}" rel="stylesheet"> --}}
    <!-- Filepond plugin, add to document <head> -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />

    {{-- Manifest --}}
    <link rel="manifest" type="application/manifest+json" href="manifest.webmanifest">

    {{-- IOS support --}}
    <link rel="apple-touch-icon" href="img/musical-note.png">
    <meta name="apple-mobile-web-app-status-bar" content="#aa7700">
</head>
<body>

    <br>
    @yield('content')
    <br>
    <br>

    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            @include('inc/messages')
        </div>
        <div class="col-sm-4"></div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>
</body>
</html>
