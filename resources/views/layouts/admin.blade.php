<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex">

        <title>@yield('title', 'Admin Panel - DarFolio')</title>

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="admin-theme flex min-h-screen flex-col bg-background font-sans text-on-surface antialiased selection:bg-orange-800 selection:text-white">
        @yield('body')
    </body>
</html>
