<!DOCTYPE html>
<html lang="{{ app()->currentLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}"/>
    <title>@yield('title', config('app.name'))</title>
    @livewireStyles
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
    @yield('content')
    @livewireScripts
    @livewire('wire-elements-modal')
</body>
</html>