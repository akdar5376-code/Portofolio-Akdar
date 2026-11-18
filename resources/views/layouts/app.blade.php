@php
    $siteProfile = $profile ?? \App\Models\Profile::current();
    $navItems = [
        [
            'label' => 'Beranda',
            'route' => 'home',
            'active' => 'home',
            'accent' => [
                'dot' => 'bg-orange-700',
                'text' => 'text-orange-800 dark:text-orange-300',
                'hover' => 'hover:bg-orange-700/10 hover:text-orange-800 dark:hover:text-orange-300',
                'active' => 'bg-orange-700/15 text-orange-900 ring-1 ring-inset ring-orange-700/30 dark:text-orange-300',
            ],
        ],
        [
            'label' => 'Tentang',
            'route' => 'about',
            'active' => 'about',
            'accent' => [
                'dot' => 'bg-orange-700',
                'text' => 'text-orange-800 dark:text-orange-300',
                'hover' => 'hover:bg-orange-700/10 hover:text-orange-800 dark:hover:text-orange-300',
                'active' => 'bg-orange-700/15 text-orange-900 ring-1 ring-inset ring-orange-700/30 dark:text-orange-300',
            ],
        ],
        [
            'label' => 'Keahlian',
            'route' => 'skills',
            'active' => 'skills',
            'accent' => [
                'dot' => 'bg-orange-700',
                'text' => 'text-orange-800 dark:text-orange-300',
                'hover' => 'hover:bg-orange-700/10 hover:text-orange-800 dark:hover:text-orange-300',
                'active' => 'bg-orange-700/15 text-orange-900 ring-1 ring-inset ring-orange-700/30 dark:text-orange-300',
            ],
        ],
        [
            'label' => 'Proyek',
            'route' => 'projects.index',
            'active' => 'projects.*',
            'accent' => [
                'dot' => 'bg-orange-700',
                'text' => 'text-orange-800 dark:text-orange-300',
                'hover' => 'hover:bg-orange-700/10 hover:text-orange-800 dark:hover:text-orange-300',
                'active' => 'bg-orange-700/15 text-orange-900 ring-1 ring-inset ring-orange-700/30 dark:text-orange-300',
            ],
        ],
        [
            'label' => 'Sertifikat',
            'route' => 'certificates',
            'active' => 'certificates',
            'accent' => [
                'dot' => 'bg-orange-700',
                'text' => 'text-orange-800 dark:text-orange-300',
                'hover' => 'hover:bg-orange-700/10 hover:text-orange-800 dark:hover:text-orange-300',
                'active' => 'bg-orange-700/15 text-orange-900 ring-1 ring-inset ring-orange-700/30 dark:text-orange-300',
            ],
        ],
        [
            'label' => 'Blog',
            'route' => 'posts.index',
            'active' => 'posts.*',
            'accent' => [
                'dot' => 'bg-orange-700',
                'text' => 'text-orange-800 dark:text-orange-300',
                'hover' => 'hover:bg-orange-700/10 hover:text-orange-800 dark:hover:text-orange-300',
                'active' => 'bg-orange-700/15 text-orange-900 ring-1 ring-inset ring-orange-700/30 dark:text-orange-300',
            ],
        ],
        [
            'label' => 'Testimoni',
            'route' => 'testimonies',
            'active' => 'testimonies',
            'accent' => [
                'dot' => 'bg-orange-700',
                'text' => 'text-orange-800 dark:text-orange-300',
                'hover' => 'hover:bg-orange-700/10 hover:text-orange-800 dark:hover:text-orange-300',
                'active' => 'bg-orange-700/15 text-orange-900 ring-1 ring-inset ring-orange-700/30 dark:text-orange-300',
            ],
        ],
        [
            'label' => 'Hubungi Saya',
            'route' => 'contact',
            'active' => 'contact',
            'accent' => [
                'dot' => 'bg-teal-500',
                'text' => 'text-teal-700 dark:text-teal-300',
                'hover' => 'hover:bg-teal-500/10 hover:text-teal-700 dark:hover:text-teal-300',
                'active' => 'bg-teal-500/15 text-teal-800 ring-1 ring-inset ring-teal-500/30 dark:text-teal-300',
            ],
        ],
    ];
@endphp
<!DOCTYPE html>
<html class="dark scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="@yield('description', 'Portofolio '.$siteProfile->full_name.' — '.$siteProfile->role.'. Kumpulan proyek web, mobile, dan IoT, sertifikat, pengalaman, serta CV digital.')">

        <title>@yield('title', $siteProfile->full_name.' | '.$siteProfile->role)</title>

        <script>
            (function () {
                var stored = localStorage.getItem('theme');
                var useDark = stored ? stored === 'dark' : true;
                document.documentElement.classList.toggle('dark', useDark);
            })();
        </script>

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body @class([
        'flex min-h-screen flex-col bg-background font-sans text-on-surface antialiased selection:text-white',
        'portfolio-theme selection:bg-orange-800',
    ])>
        @include('layouts.partials.site-header', ['siteProfile' => $siteProfile, 'navItems' => $navItems])

        <main class="page-transition flex-grow">
            @yield('content')
        </main>

        @include('layouts.partials.site-footer', ['siteProfile' => $siteProfile, 'navItems' => $navItems])
        @include('layouts.partials.toast')
        <x-back-to-top />
        <x-project-preview-modal />
    </body>
</html>
