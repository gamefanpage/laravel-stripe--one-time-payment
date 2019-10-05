<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/img/apple-touch-icon/180x180.png') }}">
    <link rel="icon" href="{{ asset('assets/img/apple-touch-icon/180x180.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Stripe - One Time Payment') }}</title>

    <!-- Scripts -->
    <script src="https://js.stripe.com/v3/"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro" rel="stylesheet">

    <!-- Styles -->
    @yield('extra-style')
    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/form-validation.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
    <div id="app">
        @yield('nav')
        @yield('content')
    </div>
    <!-- Optional JavaScript -->
    @yield('extra-js')
    <script src="{{ asset('assets/js/jquery-slim.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
</body>
</html>
