<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hotspot</title>
    @vite('resources/js/app.js')
</head>
<body class="h-full">
<div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 px-20">
    @yield('content')
</div>
</body>
</html>
