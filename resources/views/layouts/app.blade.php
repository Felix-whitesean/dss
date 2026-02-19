<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))
    </title>
    <link rel="icon" href="{{asset('images/favicon.png')}}" type="icon">
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="h-screen">
    @yield('content')
    @livewireScripts
</body>
</html>
