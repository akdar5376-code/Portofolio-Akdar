@php
    $siteProfile = $profile ?? \App\Models\Profile::current();
    $navItems = [
        [
            'label' => 'Beranda',
            'route' => 'home',
            'active' => 'home',
            'accent' => [
                'dot' => 'bg-indigo-500',
                'text' => 'text-indigo-700 dark:text-indigo-300',
                'hover' => 'hover:bg-indigo-500/10 hover:text-indigo-700 dark:hover:text-indigo-300',
                'active' => 'bg-indigo-500/15 text-indigo-700 ring-1 ring-inset ring-indigo-500/30 dark:text-indigo-300',
            ],
        ],
        [
            'label' => 'Tentang',
            'route' => 'about',
            'active' => 'about',
            'accent' => [
                'dot' => 'bg-indigo-500',
                'text' => 'text-indigo-700 dark:text-indigo-300',
                'hover' => 'hover:bg-indigo-500/10 hover:text-indigo-700 dark:hover:text-indigo-300',
                'active' => 'bg-indigo-500/15 text-indigo-700 ring-1 ring-inset ring-indigo-500/30 dark:text-indigo-300',
            ],
        ],
        [
            'label' => 'Keahlian',
            'route' => 'skills',
            'active' => 'skills',
            'accent' => [
                'dot' => 'bg-indigo-500',
                'text' => 'text-indigo-700 dark:text-indigo-300',
                'hover' => 'hover:bg-indigo-500/10 hover:text-indigo-700 dark:hover:text-indigo-300',
                'active' => 'bg-indigo-500/15 text-indigo-700 ring-1 ring-inset ring-indigo-500/30 dark:text-indigo-300',
            ],
        ],
        [
            'label' => 'Proyek',
            'route' => 'projects.index',
            'active' => 'projects.*',
            'accent' => [
                'dot' => 'bg-indigo-500',
                'text' => 'text-indigo-700 dark:text-indigo-300',
                'hover' => 'hover:bg-indigo-500/10 hover:text-indigo-700 dark:hover:text-indigo-300',
                'active' => 'bg-indigo-500/15 text-indigo-700 ring-1 ring-inset ring-indigo-500/30 dark:text-indigo-300',
            ],
        ],
        [
            'label' => 'Sertifikat',
            'route' => 'certificates',
            'active' => 'certificates',
            'accent' => [
                'dot' => 'bg-indigo-500',
                'text' => 'text-indigo-700 dark:text-indigo-300',
                'hover' => 'hover:bg-indigo-500/10 hover:text-indigo-700 dark:hover:text-indigo-300',
                'active' => 'bg-indigo-500/15 text-indigo-700 ring-1 ring-inset ring-indigo-500/30 dark:text-indigo-300',
            ],
        ],
        [
            'label' => 'Pengalaman',
            'route' => 'experience',
            'active' => 'experience',
            'accent' => [
                'dot' => 'bg-indigo-500',
                'text' => 'text-indigo-700 dark:text-indigo-300',
                'hover' => 'hover:bg-indigo-500/10 hover:text-indigo-700 dark:hover:text-indigo-300',
                'active' => 'bg-indigo-500/15 text-indigo-700 ring-1 ring-inset ring-indigo-500/30 dark:text-indigo-300',
            ],
        ],
        [
            'label' => 'Blog',
            'route' => 'posts.index',
            'active' => 'posts.*',
            'accent' => [
                'dot' => 'bg-indigo-500',
                'text' => 'text-indigo-700 dark:text-indigo-300',
                'hover' => 'hover:bg-indigo-500/10 hover:text-indigo-700 dark:hover:text-indigo-300',
                'active' => 'bg-indigo-500/15 text-indigo-700 ring-1 ring-inset ring-indigo-500/30 dark:text-indigo-300',
            ],
        ],
        [
            'label' => 'Testimoni',
            'route' => 'testimonies',
            'active' => 'testimonies',
            'accent' => [
                'dot' => 'bg-indigo-500',
                'text' => 'text-indigo-700 dark:text-indigo-300',
                'hover' => 'hover:bg-indigo-500/10 hover:text-indigo-700 dark:hover:text-indigo-300',
                'active' => 'bg-indigo-500/15 text-indigo-700 ring-1 ring-inset ring-indigo-500/30 dark:text-indigo-300',
            ],
        ],
        [
            'label' => 'CV',
            'route' => 'cv',
            'active' => 'cv',
            'accent' => [
                'dot' => 'bg-indigo-500',
                'text' => 'text-indigo-700 dark:text-indigo-300',
                'hover' => 'hover:bg-indigo-500/10 hover:text-indigo-700 dark:hover:text-indigo-300',
                'active' => 'bg-indigo-500/15 text-indigo-700 ring-1 ring-inset ring-indigo-500/30 dark:text-indigo-300',
            ],
        ],
        [
            'label' => 'Hubungi Saya',
            'route' => 'contact',
            'active' => 'contact',
            'accent' => [
                'dot' => 'bg-indigo-500',
                'text' => 'text-indigo-700 dark:text-indigo-300',
                'hover' => 'hover:bg-indigo-500/10 hover:text-indigo-700 dark:hover:text-indigo-300',
                'active' => 'bg-indigo-500/15 text-indigo-700 ring-1 ring-inset ring-indigo-500/30 dark:text-indigo-300',
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
    <body class="flex min-h-screen flex-col bg-background font-sans text-on-surface antialiased selection:bg-indigo-500 selection:text-white">
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
