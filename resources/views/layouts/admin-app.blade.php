@php
    $adminProfile = \App\Models\Profile::current();
    $unreadMessages = \App\Models\Message::query()->unread()->count();
    $adminInitials = \Illuminate\Support\Str::of(auth()->user()->name)
        ->explode(' ')
        ->map(fn ($part) => \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($part, 0, 1)))
        ->take(2)
        ->implode('');
    $adminNav = [
        ['label' => 'Dasbor', 'route' => 'admin.dashboard', 'active' => 'admin.dashboard', 'icon' => 'layout-dashboard'],
        ['label' => 'Proyek', 'route' => 'admin.projects.index', 'active' => 'admin.projects.*', 'icon' => 'layers'],
        ['label' => 'Konten', 'route' => 'admin.content.index', 'active' => 'admin.content.*', 'icon' => 'sparkles'],
        ['label' => 'Sertifikat', 'route' => 'admin.certificates.index', 'active' => 'admin.certificates.*', 'icon' => 'award'],
        ['label' => 'Testimoni', 'route' => 'admin.testimonies.index', 'active' => 'admin.testimonies.*', 'icon' => 'quote'],
        ['label' => 'Pesan', 'route' => 'admin.messages.index', 'active' => 'admin.messages.*', 'icon' => 'message-square'],
        ['label' => 'Profil', 'route' => 'admin.profile.edit', 'active' => 'admin.profile.*', 'icon' => 'user'],
    ];
@endphp
<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex">

        <title>@yield('title', 'Dasbor') - Admin {{ $adminProfile->full_name }}</title>

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-background font-sans text-on-surface antialiased selection:bg-indigo-500 selection:text-white">
        <div class="grid-pattern pointer-events-none fixed inset-0 opacity-50"></div>

        <aside
            class="fixed inset-y-0 left-0 z-50 flex w-64 -translate-x-full flex-col border-r border-surface-highest bg-surface-lowest transition-transform duration-300 lg:translate-x-0"
            data-admin-sidebar
        >
            <div class="flex h-16 items-center gap-2.5 border-b border-surface-highest px-5">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
                    <div class="size-9 rounded-xl bg-gradient-to-tr from-indigo-600 via-blue-500 to-cyan-400 p-px shadow-lg shadow-indigo-500/20">
                        <div class="flex size-full items-center justify-center rounded-[11px] bg-background">
                            <span class="font-mono text-sm font-bold text-white">D</span>
                        </div>
                    </div>
                    <span class="text-base font-extrabold tracking-tight text-heading">Admin<span class="text-blue-500 dark:text-blue-400">Panel</span></span>
                </a>
            </div>

            <div class="flex items-center gap-3 border-b border-surface-highest px-5 py-4">
                <div class="flex size-10 shrink-0 items-center justify-center overflow-hidden rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 font-mono text-xs font-bold text-white ring-2 ring-blue-400/20">
                    @if ($adminProfile->avatar_url)
                        <img src="{{ $adminProfile->avatar_url }}" alt="{{ $adminProfile->full_name }}" class="h-full w-full object-cover object-top">
                    @else
                        {{ $adminInitials }}
                    @endif
                </div>
                <div class="min-w-0">
                    <p class="truncate text-sm font-bold text-heading">{{ $adminProfile->full_name }}</p>
                    <p class="truncate font-mono text-[10px] text-outline">{{ $adminProfile->role }}</p>
                </div>
            </div>

            <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-4" aria-label="Navigasi admin">
                @foreach ($adminNav as $item)
                    <a
                        href="{{ route($item['route']) }}"
                        @class([
                            'flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold transition-colors',
                            'bg-blue-600 text-white shadow-md shadow-blue-600/20' => request()->routeIs($item['active']),
                            'text-on-surface-variant hover:bg-surface-container hover:text-heading' => ! request()->routeIs($item['active']),
                        ])
                    >
                        <x-icon :name="$item['icon']" class="size-[18px]" />
                        <span>{{ $item['label'] }}</span>
                        @if ($item['route'] === 'admin.messages.index' && $unreadMessages > 0)
                            <span class="ml-auto flex min-w-5 items-center justify-center rounded-full bg-red-500 px-1.5 py-0.5 font-mono text-[10px] font-bold text-white">{{ $unreadMessages }}</span>
                        @endif
                    </a>
                @endforeach
            </nav>

            <div class="space-y-1 border-t border-surface-highest p-3">
                <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold text-on-surface-variant transition-colors hover:bg-surface-container hover:text-heading">
                    <x-icon name="external-link" class="size-[18px]" />
                    Lihat Website
                </a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="flex w-full cursor-pointer items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold text-red-500 transition-colors hover:bg-red-500/10">
                        <x-icon name="log-out" class="size-[18px]" />
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <div class="fixed inset-0 z-40 hidden bg-slate-950/60 backdrop-blur-sm lg:hidden" data-admin-overlay></div>

        <div class="relative z-10 flex min-h-screen flex-col lg:pl-64">
            <header class="sticky top-0 z-30 flex h-16 items-center justify-between gap-4 border-b border-surface-highest bg-background/90 px-4 backdrop-blur-xl sm:px-6 lg:px-8">
                <div class="flex items-center gap-3">
                    <button type="button" class="flex size-9 cursor-pointer items-center justify-center rounded-lg border border-surface-highest bg-surface-low text-on-surface lg:hidden" data-admin-sidebar-toggle aria-label="Buka menu admin">
                        <x-icon name="menu" class="size-5" />
                    </button>
                    <div>
                        <p class="font-mono text-[10px] uppercase tracking-widest text-outline">Panel Admin</p>
                        <h1 class="text-sm font-bold text-heading sm:text-base">@yield('heading', 'Dasbor')</h1>
                    </div>
                </div>
            </header>

            <main class="flex-grow px-4 py-6 sm:px-6 lg:px-8">
                <div class="mx-auto w-full max-w-7xl">
                    @yield('content')
                </div>
            </main>

            <footer class="border-t border-surface-highest px-4 py-4 sm:px-6 lg:px-8">
                <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-2 font-mono text-[10px] text-outline sm:flex-row">
                    <span>&copy; {{ now()->year }} DarFolio Admin Panel</span>
                    <span class="flex items-center gap-1.5">
                        <span class="size-1.5 rounded-full bg-emerald-500"></span>
                        Terhubung ke database
                    </span>
                </div>
            </footer>
        </div>

        @include('layouts.partials.toast')
    </body>
</html>
