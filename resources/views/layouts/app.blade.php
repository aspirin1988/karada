<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="/images/favicon.png">

    @hasSection('title')
        @yield('title')
    @else
        <title>Малобюджетный маркетинг, реклама, продвижение и продажи</title>
    @endif

<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.css')
</head>
<body>
@include('layouts.header')
<main>
    @yield('content')
</main>
@include('layouts.footer')
</body>
@include('layouts.script')
</html>
