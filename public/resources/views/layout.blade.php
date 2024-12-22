<!DOCTYPE html>
<html lang="ru">
<head>
    @section('head')
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <link href="/css/normalize.min.css" rel="stylesheet">
        <link href="/css/style.css" rel="stylesheet">
    @show
</head>
<body>
    <div class="page-wrapper">
        <x-header></x-header>
        @yield('page-content')
    </div>
    <x-footer></x-footer>
    @yield('scripts')
</body>
</html>
