<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Baýramgeldi Mätiýev - ATM H.J.">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon.ico') }}">
    <title>Панель администратора</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('header')
</head>

<body class="skin-blue fixed-layout">
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Realestate - Панель администратора</p>
        </div>
    </div>
    <div id="main-wrapper">
        @yield('topbar')
        @yield('sidebar')
        @yield('content')
    </div>
   @yield('footer')
</body>
</html>