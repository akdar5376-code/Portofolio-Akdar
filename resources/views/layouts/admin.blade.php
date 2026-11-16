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
    <body class="relative flex min-h-screen flex-col bg-background font-sans text-on-surface antialiased selection:bg-indigo-500 selection:text-white">
        <div class="grid-pattern pointer-events-none fixed inset-0 opacity-60"></div>
        <div class="pointer-events-none fixed left-1/4 top-12 size-[500px] rounded-full bg-indigo-600/10 blur-[140px]"></div>
        <div class="pointer-events-none fixed bottom-10 right-1/4 size-[450px] rounded-full bg-cyan-500/10 blur-[130px]"></div>

        @yield('body')
    </body>
</html>
