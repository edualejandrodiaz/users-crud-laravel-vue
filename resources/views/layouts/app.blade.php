<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <!-- Bootstrap core CSS -->

    <!-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> -->

    <!-- <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet"> -->

    <link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div id="app">

        @yield('header')

        <main class="py-0">
            @yield('content')
        </main>
    </div>
</body>
@yield('scripts')
</html>
