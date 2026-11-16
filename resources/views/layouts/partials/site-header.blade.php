@php
    $adminUrl = auth()->check() && auth()->user()->is_admin
        ? route('admin.dashboard')
        : route('admin.login');
@endphp

<header class="sticky top-0 z-50 border-b border-surface-highest/60 bg-background/85 backdrop-blur-xl" data-purpose="site-navigation-header">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-[72px] items-center gap-4">
            <a class="group flex shrink-0 items-center gap-3" href="{{ route('home') }}" data-purpose="site-logo">
                <div class="size-10 rounded-xl bg-gradient-to-tr from-indigo-600 via-blue-500 to-cyan-400 p-px shadow-lg shadow-indigo-500/25 transition-transform duration-300 group-hover:scale-105">
                    <div class="flex h-full w-full items-center justify-center rounded-[11px] bg-background">
                        <span class="font-mono text-lg font-bold text-heading">D</span>
                    </div>
                </div>
                <span class="text-lg font-extrabold tracking-tight text-heading">
                    Dar<span class="bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent dark:from-blue-400 dark:to-cyan-300">Folio</span>
                </span>
            </a>

            <nav aria-label="Navigasi utama" class="hidden min-w-0 flex-1 items-center justify-center gap-0.5 xl:flex">
                @foreach ($navItems as $item)
                    @php($accent = $item['accent'])
                    <a
                        href="{{ route($item['route']) }}"
                        @class([
                            'flex items-center gap-1.5 whitespace-nowrap rounded-full px-2 py-2 text-[12px] font-semibold transition-colors 2xl:px-2.5 2xl:text-[13px]',
                            $accent['active'] => request()->routeIs($item['active']),
                            'text-on-surface-variant '.$accent['hover'] => ! request()->routeIs($item['active']),
                        ])
                        @if (request()->routeIs($item['active'])) aria-current="page" @endif
                    >
                        <span class="size-1.5 shrink-0 rounded-full {{ $accent['dot'] }}"></span>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="ml-auto flex shrink-0 items-center justify-end gap-2">
                <button
                    type="button"
                    class="flex size-9 cursor-pointer items-center justify-center rounded-full border border-surface-highest bg-surface-low text-on-surface-variant transition-colors hover:text-heading"
                    data-theme-toggle
                    aria-label="Ganti mode tampilan"
                    title="Ganti mode tampilan"
                >
                    <x-icon name="sun" class="hidden size-4 dark:block" />
                    <x-icon name="moon" class="size-4 dark:hidden" />
                </button>

                <a
                    href="{{ $adminUrl }}"
                    class="hidden items-center gap-1.5 rounded-full border border-surface-highest bg-surface-low px-3.5 py-2 text-xs font-semibold text-on-surface transition-colors hover:border-blue-500/40 hover:text-blue-600 sm:inline-flex dark:hover:text-blue-300"
                >
                    <span class="size-1.5 animate-pulse rounded-full bg-emerald-500"></span>
                    {{ auth()->check() && auth()->user()->is_admin ? 'Panel Admin' : 'Admin' }}
                </a>

                <button
                    type="button"
                    class="flex size-9 cursor-pointer items-center justify-center rounded-full border border-surface-highest bg-surface-low text-on-surface transition-colors hover:text-heading xl:hidden"
                    data-mobile-nav-toggle
                    aria-expanded="false"
                    aria-controls="mobile-navigation"
                    aria-label="Buka menu navigasi"
                >
                    <x-icon name="menu" class="size-5" />
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-navigation" class="hidden border-t border-surface-highest/60 bg-background px-4 pb-5 pt-3 sm:px-6 xl:hidden" data-mobile-nav>
        <nav aria-label="Navigasi mobile" class="mx-auto grid max-w-7xl grid-cols-2 gap-2">
            @foreach ($navItems as $item)
                @php($accent = $item['accent'])
                <a
                    href="{{ route($item['route']) }}"
                    @class([
                        'flex items-center gap-2 rounded-xl border px-3.5 py-2.5 text-sm font-semibold transition-colors',
                        $accent['active'] => request()->routeIs($item['active']),
                        'border-surface-highest bg-surface-low text-on-surface-variant '.$accent['hover'] => ! request()->routeIs($item['active']),
                    ])
                    @if (request()->routeIs($item['active'])) aria-current="page" @endif
                >
                    <span class="size-1.5 shrink-0 rounded-full {{ $accent['dot'] }}"></span>
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>
        <a
            href="{{ $adminUrl }}"
            class="mx-auto mt-2 flex max-w-7xl items-center justify-center gap-2 rounded-xl border border-surface-highest bg-surface-container px-3.5 py-2.5 text-sm font-semibold text-on-surface"
        >
            <x-icon name="layout-dashboard" class="size-4" />
            {{ auth()->check() && auth()->user()->is_admin ? 'Panel Admin' : 'Masuk Admin' }}
        </a>
    </div>
</header>
