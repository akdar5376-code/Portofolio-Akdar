@extends('layouts.app')

@section('title', $profile->full_name.' | '.$profile->role)
@section('description', 'Portofolio '.$profile->full_name.', '.$profile->class_name.' '.$profile->competency.'. Lihat proyek, keahlian, sertifikat, pengalaman, dan CV digital.')

@section('content')
    @php
        $initials = \Illuminate\Support\Str::of($profile->full_name)
            ->explode(' ')
            ->map(fn ($part) => \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($part, 0, 1)))
            ->take(2)
            ->implode('');
    @endphp

    <div class="bg-[#f1eee6] text-stone-900 dark:bg-[#171815] dark:text-stone-100">
        <section class="relative overflow-hidden px-4 pb-20 pt-14 sm:px-6 sm:pb-24 sm:pt-20 lg:px-8" id="home" data-purpose="hero-identity-section">
            <div class="mx-auto grid max-w-6xl items-center gap-14 lg:grid-cols-[minmax(0,1.15fr)_minmax(20rem,0.85fr)] lg:gap-20">
            <div class="relative z-10 min-w-0 text-left">
                <p class="mb-4 text-sm font-medium text-orange-800 dark:text-orange-300">
                    {{ $profile->role ?: 'Junior Developer' }}
                </p>

                <h1 class="max-w-3xl text-4xl font-semibold leading-[1.08] tracking-tight text-heading sm:text-5xl md:text-7xl">
                    Halo, saya {{ $profile->full_name }}
                </h1>

                <div class="mt-6 flex flex-wrap items-center gap-x-5 gap-y-2 text-sm text-on-surface-variant">
                    @if ($profile->class_name)
                        <span class="inline-flex items-center gap-2">
                            <x-icon name="graduation-cap" class="size-4 text-orange-800 dark:text-orange-300" />
                            {{ $profile->class_name }}
                        </span>
                    @endif
                    @if ($profile->competency)
                        <span class="inline-flex items-center gap-2">
                            <x-icon name="code" class="size-4 text-orange-800 dark:text-orange-300" />
                            {{ $profile->competency }}
                        </span>
                    @endif
                </div>

                <p class="mt-7 max-w-xl text-base leading-8 text-on-surface-variant sm:text-lg">
                    {{ $profile->tagline ?: 'Membangun solusi digital melalui kode yang bersih dan efisien.' }}
                </p>

                <div class="mt-9 flex flex-col items-start gap-3 sm:flex-row sm:flex-wrap">
                    <a
                        href="{{ route('projects.index') }}"
                        class="group flex w-full items-center justify-center gap-2 rounded-md bg-orange-800 px-6 py-3.5 text-sm font-semibold text-white transition-colors hover:bg-orange-900 sm:w-auto dark:bg-orange-300 dark:text-stone-950 dark:hover:bg-orange-200"
                    >
                        Lihat Portfolio
                        <x-icon name="arrow-right" class="size-4 transition-transform group-hover:translate-x-0.5" />
                    </a>
                    <a
                        href="{{ route('cv') }}"
                        class="flex w-full items-center justify-center gap-2 rounded-md border border-surface-highest px-6 py-3.5 text-sm font-semibold text-on-surface transition-colors hover:border-orange-700 sm:w-auto"
                    >
                        <x-icon name="file-text" class="size-4 text-orange-700 dark:text-orange-300" />
                        Lihat CV
                    </a>
                    <a
                        href="{{ route('contact') }}"
                        class="flex w-full items-center justify-center gap-2 rounded-md border border-surface-highest px-6 py-3.5 text-sm font-semibold text-on-surface transition-colors hover:border-orange-700 hover:text-orange-800 sm:w-auto dark:hover:text-orange-300"
                    >
                        <x-icon name="message-circle" class="size-4" />
                        Hubungi Saya
                    </a>
                </div>

                @if (count($profile->social_links))
                    <div class="mt-8 flex items-center gap-2">
                        @foreach ($profile->social_links as $social)
                            <a
                                href="{{ $social['url'] }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex size-9 items-center justify-center rounded-full border border-surface-highest bg-surface-low text-on-surface-variant transition-colors hover:border-orange-700 hover:text-orange-800 dark:hover:text-orange-300"
                                aria-label="{{ $social['label'] }}"
                            >
                                <x-icon :name="$social['icon']" class="size-4" />
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="relative z-0 mx-auto w-full max-w-sm pb-14 sm:pb-16 lg:justify-self-end">
                <div class="pointer-events-none absolute -inset-8 flex items-center justify-center">
                    <div class="photo-halo size-full max-w-[22rem] rounded-full bg-orange-500/25 blur-3xl"></div>
                </div>

                <div class="photo-float group relative">
                    <div class="pointer-events-none absolute -inset-4 rounded-[3rem] border border-dashed border-orange-700/25 sm:-inset-5 dark:border-orange-300/20"></div>

                    <div class="photo-ring relative z-0 rounded-[2.5rem] p-[3px] shadow-[0_30px_70px_-30px_rgba(154,67,30,0.65)]">
                        <div class="photo-frame relative overflow-hidden rounded-[2.25rem] bg-surface-container">
                            <div class="grid-pattern pointer-events-none absolute inset-0 z-0 opacity-50"></div>

                            @if ($profile->avatar_url)
                                <img src="{{ $profile->avatar_url }}" alt="Foto profil {{ $profile->full_name }}" class="relative z-10 mx-auto block h-auto max-h-[32rem] w-full object-contain">
                            @else
                                <div class="relative z-10 flex aspect-[4/5] w-full flex-col items-center justify-center gap-4">
                                    <div class="flex size-28 items-center justify-center rounded-full border border-orange-700/30 bg-orange-700/10">
                                        <span class="text-4xl font-bold text-orange-800 dark:text-orange-300">{{ $initials }}</span>
                                    </div>
                                    <p class="font-mono text-[11px] uppercase tracking-widest text-outline">Foto profil</p>
                                </div>
                            @endif

                            <div class="photo-shimmer pointer-events-none absolute inset-0 z-20 overflow-hidden rounded-[2.25rem]"></div>
                            <div class="pointer-events-none absolute inset-0 z-30 rounded-[2.25rem] ring-1 ring-inset ring-white/25 dark:ring-white/10"></div>
                        </div>
                    </div>

                    <div class="photo-badge absolute left-0 top-8 z-20 flex items-center gap-2 rounded-full border border-surface-highest bg-surface-lowest/90 px-3 py-1.5 text-[11px] font-semibold text-on-surface shadow-lg backdrop-blur sm:-left-5">
                        <span class="relative flex size-2">
                            <span class="absolute inline-flex size-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex size-2 rounded-full bg-emerald-500"></span>
                        </span>
                        Open to Projects
                    </div>

                    <div class="photo-badge absolute right-0 top-28 z-20 flex items-center gap-1.5 rounded-full border border-surface-highest bg-surface-lowest/90 px-3 py-1.5 font-mono text-[10px] font-bold text-orange-800 shadow-lg backdrop-blur sm:-right-4 dark:text-orange-300" style="animation-delay: -2.2s">
                        <x-icon name="graduation-cap" class="size-3.5" />
                        {{ $profile->class_name ?: 'RPL' }}
                    </div>

                    <div class="absolute -bottom-7 left-1/2 z-20 w-[86%] -translate-x-1/2 rounded-2xl border border-surface-highest bg-surface-lowest/95 px-4 py-3 shadow-xl backdrop-blur">
                        <div class="flex items-center justify-between gap-3">
                            <div class="min-w-0">
                                <p class="font-mono text-[9px] uppercase tracking-widest text-outline">Kompetensi</p>
                                <p class="mt-0.5 truncate text-sm font-bold text-heading">{{ $profile->competency ?: 'Rekayasa Perangkat Lunak' }}</p>
                            </div>
                            <span class="flex size-8 shrink-0 items-center justify-center rounded-full bg-orange-700/10 text-orange-800 dark:bg-orange-300/10 dark:text-orange-300">
                                <x-icon name="code" class="size-4" />
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>

    <section class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8" data-purpose="skills-preview">
        <div class="mb-10 flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
            <div class="max-w-xl">
                <span class="mb-2 inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-widest text-orange-800 dark:text-orange-300">
                    <span class="h-px w-6 bg-orange-700"></span>
                    Keahlian Utama
                </span>
                <h2 class="text-2xl font-extrabold tracking-tight text-heading sm:text-3xl">Yang saya kuasai</h2>
                <p class="mt-2 text-sm leading-relaxed text-on-surface-variant">Kombinasi kemampuan teknis dan non-teknis yang saya asah melalui pembelajaran, proyek, dan pengalaman organisasi.</p>
            </div>
            <a href="{{ route('skills') }}" class="flex items-center gap-1.5 rounded-lg border border-surface-highest bg-surface-low px-4 py-2.5 text-xs font-semibold text-on-surface transition-colors hover:border-orange-700 hover:text-orange-800 dark:hover:text-orange-300">
                Semua keahlian
                <x-icon name="arrow-right" class="size-3.5" />
            </a>
        </div>

        <div class="grid gap-10 border-t border-surface-highest py-8 lg:grid-cols-2">
            <div>
                <div class="mb-5 flex items-center gap-3">
                    <span class="text-orange-800 dark:text-orange-300"><x-icon name="terminal" class="size-5" /></span>
                    <div>
                        <h3 class="text-sm font-bold text-heading">Hard Skill</h3>
                        <p class="font-mono text-[10px] uppercase tracking-widest text-outline">Teknis</p>
                    </div>
                </div>
                <div class="space-y-4">
                    @forelse ($hardSkills as $skill)
                        <x-skill-bar :skill="$skill" />
                    @empty
                        <p class="text-sm text-on-surface-variant">Belum ada data hard skill.</p>
                    @endforelse
                </div>
            </div>

            <div>
                <div class="mb-5 flex items-center gap-3">
                    <span class="text-orange-800 dark:text-orange-300"><x-icon name="users" class="size-5" /></span>
                    <div>
                        <h3 class="text-sm font-bold text-heading">Soft Skill</h3>
                        <p class="font-mono text-[10px] uppercase tracking-widest text-outline">Non-teknis</p>
                    </div>
                </div>
                <div class="space-y-4">
                    @forelse ($softSkills as $skill)
                        <x-skill-bar :skill="$skill" />
                    @empty
                        <p class="text-sm text-on-surface-variant">Belum ada data soft skill.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <section class="relative z-20 mx-auto max-w-7xl scroll-mt-24 border-t border-surface-highest/50 px-4 py-20 sm:px-6 lg:px-8" data-purpose="portfolio-gallery-section" id="portfolio">

        <div class="relative z-10 mb-8 max-w-2xl">
            <span class="mb-3 inline-flex items-center gap-2 border-b border-orange-700/40 pb-2 text-xs font-semibold uppercase tracking-widest text-orange-800 dark:text-orange-300">
                <span class="size-1.5 rounded-full bg-orange-700"></span>
                Galeri Proyek
            </span>
            <h2 class="mb-3 text-3xl font-semibold tracking-tight text-heading sm:text-4xl">Proyek Pilihan Saya</h2>
            <p class="max-w-lg text-sm leading-relaxed text-on-surface-variant sm:text-base">Kumpulan karya dan proyek aplikasi yang pernah saya rancang dan kembangkan.</p>
        </div>

        <div class="relative z-10 mb-8 flex flex-wrap items-center justify-center gap-2">
            <a
                href="{{ route('home') }}#portfolio"
                @class([
                    'rounded-full border px-4 py-2 text-xs font-semibold transition-colors',
                    'border-orange-800 bg-orange-800 text-white' => $activeCategory === null,
                    'border-surface-highest bg-surface-low text-on-surface-variant hover:text-heading' => $activeCategory !== null,
                ])
            >Semua</a>
            @foreach ($categories as $category)
                <a
                    href="{{ route('home', ['category' => $category]) }}#portfolio"
                    @class([
                        'rounded-full border px-4 py-2 text-xs font-semibold transition-colors',
                        'border-orange-800 bg-orange-800 text-white' => $activeCategory === $category,
                        'border-surface-highest bg-surface-low text-on-surface-variant hover:text-heading' => $activeCategory !== $category,
                    ])
                >{{ \App\Enums\ProjectCategory::tryFrom($category)?->label() ?? $category }}</a>
            @endforeach
        </div>

        @if ($projects->isEmpty())
            <div class="relative z-10 my-8 rounded-3xl border border-surface-highest bg-surface-low/80 py-20 text-center shadow-xl" id="no-projects-message">
                <div class="mx-auto mb-4 flex size-16 items-center justify-center rounded-lg border border-surface-highest bg-surface-high text-orange-800 dark:text-orange-300">
                    <x-icon name="folder-off" class="size-8" />
                </div>
                <p class="text-base font-semibold text-heading">Tidak ada proyek yang sesuai kategori ini.</p>
                <p class="mt-1 text-xs text-on-surface-variant">Coba pilih kategori lain atau lihat seluruh proyek.</p>
                <a href="{{ route('home') }}#portfolio" class="mt-5 inline-flex items-center gap-1.5 rounded-lg bg-orange-800 px-4 py-2 text-xs font-semibold text-white">Lihat semua proyek</a>
            </div>
        @else
            <div class="relative z-10 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3" data-purpose="projects-list-container">
                @foreach ($projects as $project)
                    <x-project-card :project="$project" />
                @endforeach
            </div>
        @endif

        <div class="mt-10 text-center">
            <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-surface-highest bg-surface-low px-5 py-2.5 text-xs font-semibold text-on-surface transition-colors hover:border-orange-700 hover:text-orange-800 dark:hover:text-orange-300">
                Jelajahi semua proyek
                <x-icon name="arrow-right" class="size-3.5" />
            </a>
        </div>
    </section>
</div>
@endsection
