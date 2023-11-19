<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Tektik Asset')</title>

    <link rel="shortcut icon" href="{{ asset('assets/img/newlogomx.png')}}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    
    @include('includes.style')
</head>

<body>
    <div id="app">
        @include('includes.sidebar')
        <!-- Page Content -->
        @yield('main')
    </div>
    
    @include('includes.script')
    @include('includes.sweetalert2')
    @stack('script')
    @include('includes.select2')
</body>

</html>