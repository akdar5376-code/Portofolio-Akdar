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

    <section class="hero-gradient relative overflow-hidden px-4 pb-20 pt-16 sm:px-6 sm:pb-24 sm:pt-20 lg:px-8" id="home" data-purpose="hero-identity-section">
        <div class="grid-pattern pointer-events-none absolute inset-0 opacity-80"></div>
        <div class="pointer-events-none absolute -left-20 top-24 size-80 rounded-full bg-indigo-500/15 blur-[120px]"></div>
        <div class="pointer-events-none absolute -right-16 bottom-0 size-80 rounded-full bg-cyan-500/15 blur-[120px]"></div>

        <div class="relative z-10 mx-auto grid max-w-6xl items-center gap-12 lg:grid-cols-[1.25fr_0.75fr]">
            <div class="text-center lg:text-left">
                <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-surface-highest bg-surface-low/80 px-3.5 py-1.5 font-mono text-[11px] text-on-surface-variant backdrop-blur-md">
                    <span class="relative flex size-2">
                        <span class="absolute inline-flex size-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex size-2 rounded-full bg-emerald-500"></span>
                    </span>
                    <span>Siswa RPL &bull; Terbuka untuk kolaborasi</span>
                </div>

                <p class="mb-3 font-mono text-xs font-semibold uppercase tracking-[0.18em] text-blue-600 dark:text-blue-300">
                    {{ $profile->role ?: 'Junior Developer' }}
                </p>

                <h1 class="text-4xl font-extrabold leading-[1.1] tracking-tight text-heading sm:text-5xl md:text-6xl">
                    Halo, saya
                    <span class="block bg-gradient-to-r from-blue-600 via-indigo-500 to-cyan-500 bg-clip-text text-transparent dark:from-blue-400 dark:via-sky-300 dark:to-cyan-300">
                        {{ $profile->full_name }}
                    </span>
                </h1>

                <div class="mt-5 flex flex-wrap items-center justify-center gap-2 lg:justify-start">
                    @if ($profile->class_name)
                        <span class="inline-flex items-center gap-1.5 rounded-lg border border-surface-highest bg-surface-low/80 px-3 py-1.5 text-xs font-semibold text-on-surface backdrop-blur">
                            <x-icon name="graduation-cap" class="size-3.5 text-blue-500" />
                            {{ $profile->class_name }}
                        </span>
                    @endif
                    @if ($profile->competency)
                        <span class="inline-flex items-center gap-1.5 rounded-lg border border-surface-highest bg-surface-low/80 px-3 py-1.5 text-xs font-semibold text-on-surface backdrop-blur">
                            <x-icon name="code" class="size-3.5 text-cyan-500" />
                            {{ $profile->competency }}
                        </span>
                    @endif
                </div>

                <p class="mx-auto mt-6 max-w-xl text-sm leading-relaxed text-on-surface-variant sm:text-base lg:mx-0">
                    {{ $profile->tagline ?: 'Membangun solusi digital melalui kode yang bersih dan efisien.' }}
                </p>

                <div class="mt-8 flex flex-col items-center gap-3 sm:flex-row sm:flex-wrap lg:justify-start">
                    <a
                        href="{{ route('projects.index') }}"
                        class="group flex w-full items-center justify-center gap-2 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 px-7 py-3.5 text-sm font-semibold text-white shadow-lg shadow-blue-600/30 transition-all duration-300 hover:-translate-y-0.5 hover:from-blue-500 hover:to-indigo-500 sm:w-auto"
                    >
                        Lihat Portfolio
                        <x-icon name="arrow-right" class="size-4 transition-transform group-hover:translate-x-0.5" />
                    </a>
                    <a
                        href="{{ route('cv') }}"
                        class="flex w-full items-center justify-center gap-2 rounded-full border border-surface-highest bg-surface-low px-7 py-3.5 text-sm font-semibold text-on-surface transition-all duration-300 hover:-translate-y-0.5 hover:border-blue-500/40 sm:w-auto"
                    >
                        <x-icon name="file-text" class="size-4 text-blue-500" />
                        Lihat CV
                    </a>
                    <a
                        href="{{ route('contact') }}"
                        class="flex w-full items-center justify-center gap-2 rounded-full border border-surface-highest bg-transparent px-7 py-3.5 text-sm font-semibold text-on-surface transition-all duration-300 hover:-translate-y-0.5 hover:border-emerald-500/40 hover:text-emerald-600 sm:w-auto dark:hover:text-emerald-300"
                    >
                        <x-icon name="message-circle" class="size-4" />
                        Hubungi Saya
                    </a>
                </div>

                @if (count($profile->social_links))
                    <div class="mt-8 flex items-center justify-center gap-2 lg:justify-start">
                        @foreach ($profile->social_links as $social)
                            <a
                                href="{{ $social['url'] }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex size-9 items-center justify-center rounded-full border border-surface-highest bg-surface-low/80 text-on-surface-variant backdrop-blur transition-colors hover:border-blue-500/40 hover:text-blue-600 dark:hover:text-blue-300"
                                aria-label="{{ $social['label'] }}"
                            >
                                <x-icon :name="$social['icon']" class="size-4" />
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="relative mx-auto w-full max-w-sm">
                <div class="absolute -inset-4 rounded-[2rem] bg-gradient-to-tr from-blue-500/20 via-indigo-500/10 to-cyan-400/20 blur-2xl"></div>
                <div class="float-slow relative overflow-hidden rounded-[2rem] border border-surface-highest bg-surface-low p-3 shadow-2xl">
                    <div class="relative aspect-[4/5] overflow-hidden rounded-[1.5rem] bg-gradient-to-b from-surface-container to-surface-high">
                        @if ($profile->avatar_url)
                            <img src="{{ $profile->avatar_url }}" alt="" aria-hidden="true" class="absolute inset-0 h-full w-full scale-110 object-cover opacity-40 blur-2xl">
                            <img src="{{ $profile->avatar_url }}" alt="Foto profil {{ $profile->full_name }}" class="relative z-10 h-full w-full object-contain">
                        @else
                            <div class="flex h-full w-full flex-col items-center justify-center gap-4">
                                <div class="flex size-28 items-center justify-center rounded-full border border-blue-500/30 bg-blue-500/10">
                                    <span class="font-mono text-4xl font-extrabold text-blue-600 dark:text-blue-300">{{ $initials }}</span>
                                </div>
                                <p class="font-mono text-[11px] uppercase tracking-widest text-outline">Foto profil</p>
                            </div>
                        @endif
                    </div>

                    <div class="relative z-10 mt-3 rounded-2xl border border-surface-highest bg-surface-lowest/95 p-4 shadow-xl backdrop-blur">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-mono text-[10px] uppercase tracking-widest text-outline">Kompetensi</p>
                                <p class="mt-0.5 text-sm font-bold text-heading">{{ $profile->competency ?: 'Rekayasa Perangkat Lunak' }}</p>
                            </div>
                            <span class="flex size-9 items-center justify-center rounded-xl bg-blue-600/10 text-blue-600 dark:text-blue-300">
                                <x-icon name="code" class="size-4" />
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>

    <section class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8" data-purpose="skills-preview">
        <div class="mb-10 flex flex-col items-center justify-between gap-4 sm:flex-row">
            <div class="max-w-xl text-center sm:text-left">
                <span class="mb-2 inline-flex items-center gap-2 font-mono text-[11px] font-semibold uppercase tracking-widest text-blue-600 dark:text-blue-300">
                    <span class="h-px w-6 bg-blue-500"></span>
                    Keahlian Utama
                </span>
                <h2 class="text-2xl font-extrabold tracking-tight text-heading sm:text-3xl">Yang saya kuasai</h2>
                <p class="mt-2 text-sm leading-relaxed text-on-surface-variant">Kombinasi kemampuan teknis dan non-teknis yang saya asah melalui pembelajaran, proyek, dan pengalaman organisasi.</p>
            </div>
            <a href="{{ route('skills') }}" class="flex items-center gap-1.5 rounded-full border border-surface-highest bg-surface-low px-4 py-2.5 text-xs font-semibold text-on-surface transition-colors hover:border-blue-500/40 hover:text-blue-600 dark:hover:text-blue-300">
                Semua keahlian
                <x-icon name="arrow-right" class="size-3.5" />
            </a>
        </div>

        <div class="grid gap-5 lg:grid-cols-2">
            <div class="rounded-2xl border border-surface-highest bg-surface-low p-6 shadow-card-dark">
                <div class="mb-5 flex items-center gap-2">
                    <span class="flex size-9 items-center justify-center rounded-xl border border-blue-500/30 bg-blue-500/10 text-blue-600 dark:text-blue-300">
                        <x-icon name="terminal" class="size-4" />
                    </span>
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

            <div class="rounded-2xl border border-surface-highest bg-surface-low p-6 shadow-card-dark">
                <div class="mb-5 flex items-center gap-2">
                    <span class="flex size-9 items-center justify-center rounded-xl border border-emerald-500/30 bg-emerald-500/10 text-emerald-600 dark:text-emerald-300">
                        <x-icon name="users" class="size-4" />
                    </span>
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

    <section class="relative z-20 mx-auto max-w-7xl border-t border-surface-highest/50 px-4 py-20 sm:px-6 lg:px-8" data-purpose="portfolio-gallery-section" id="portfolio">
        <div class="pointer-events-none absolute left-1/2 top-10 h-[300px] w-[700px] -translate-x-1/2 rounded-full bg-blue-600/5 blur-[140px]"></div>

        <div class="relative z-10 mx-auto mb-10 max-w-2xl text-center">
            <span class="mb-3 inline-flex items-center gap-2 rounded-full border border-blue-500/30 bg-surface-low px-3.5 py-1.5 font-mono text-[11px] font-semibold uppercase tracking-widest text-blue-600 dark:text-blue-300">
                <span class="size-1.5 animate-pulse rounded-full bg-blue-500"></span>
                Galeri Proyek
            </span>
            <h2 class="mb-3 text-3xl font-extrabold tracking-tight text-heading sm:text-4xl">Proyek Pilihan Saya</h2>
            <p class="mx-auto max-w-lg text-sm leading-relaxed text-on-surface-variant sm:text-base">Kumpulan karya dan proyek aplikasi yang pernah saya rancang dan kembangkan.</p>
        </div>

        <div class="relative z-10 mb-8 flex flex-wrap items-center justify-center gap-2">
            <a
                href="{{ route('home') }}"
                @class([
                    'rounded-full border px-4 py-2 text-xs font-semibold transition-colors',
                    'border-blue-500/40 bg-blue-600 text-white shadow-md shadow-blue-600/20' => $activeCategory === null,
                    'border-surface-highest bg-surface-low text-on-surface-variant hover:text-heading' => $activeCategory !== null,
                ])
            >Semua</a>
            @foreach ($categories as $category)
                <a
                    href="{{ route('home', ['category' => $category]) }}"
                    @class([
                        'rounded-full border px-4 py-2 text-xs font-semibold transition-colors',
                        'border-blue-500/40 bg-blue-600 text-white shadow-md shadow-blue-600/20' => $activeCategory === $category,
                        'border-surface-highest bg-surface-low text-on-surface-variant hover:text-heading' => $activeCategory !== $category,
                    ])
                >{{ \App\Enums\ProjectCategory::tryFrom($category)?->label() ?? $category }}</a>
            @endforeach
        </div>

        @if ($projects->isEmpty())
            <div class="relative z-10 my-8 rounded-3xl border border-surface-highest bg-surface-low/80 py-20 text-center shadow-xl" id="no-projects-message">
                <div class="mx-auto mb-4 flex size-16 items-center justify-center rounded-2xl border border-surface-highest bg-surface-high text-blue-500">
                    <x-icon name="folder-off" class="size-8" />
                </div>
                <p class="text-base font-semibold text-heading">Tidak ada proyek yang sesuai kategori ini.</p>
                <p class="mt-1 text-xs text-on-surface-variant">Coba pilih kategori lain atau lihat seluruh proyek.</p>
                <a href="{{ route('home') }}" class="mt-5 inline-flex items-center gap-1.5 rounded-full bg-blue-600 px-4 py-2 text-xs font-semibold text-white">Lihat semua proyek</a>
            </div>
        @else
            <div class="relative z-10 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3" data-purpose="projects-list-container">
                @foreach ($projects as $project)
                    <x-project-card :project="$project" />
                @endforeach
            </div>
        @endif

        <div class="mt-10 text-center">
            <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 rounded-full border border-surface-highest bg-surface-low px-5 py-2.5 text-xs font-semibold text-on-surface transition-colors hover:border-blue-500/40 hover:text-blue-600 dark:hover:text-blue-300">
                Jelajahi semua proyek
                <x-icon name="arrow-right" class="size-3.5" />
            </a>
        </div>
    </section>

    <section class="mx-auto max-w-7xl border-t border-surface-highest/50 px-4 py-20 sm:px-6 lg:px-8" data-purpose="testimonies-preview">
        <div class="mb-10 flex flex-col items-center justify-between gap-4 sm:flex-row">
            <div class="max-w-xl text-center sm:text-left">
                <span class="mb-2 inline-flex items-center gap-2 font-mono text-[11px] font-semibold uppercase tracking-widest text-blue-600 dark:text-blue-300">
                    <span class="h-px w-6 bg-blue-500"></span>
                    Testimoni
                </span>
                <h2 class="text-2xl font-extrabold tracking-tight text-heading sm:text-3xl">Kata mereka tentang saya</h2>
                <p class="mt-2 text-sm leading-relaxed text-on-surface-variant">Penilaian dari guru pembimbing, teman, pengguna produk, dan pembimbing di tempat PLK.</p>
            </div>
            <a href="{{ route('testimonies') }}" class="flex items-center gap-1.5 rounded-full border border-surface-highest bg-surface-low px-4 py-2.5 text-xs font-semibold text-on-surface transition-colors hover:border-blue-500/40 hover:text-blue-600 dark:hover:text-blue-300">
                Semua testimoni
                <x-icon name="arrow-right" class="size-3.5" />
            </a>
        </div>

        @if ($testimonies->isEmpty())
            <p class="rounded-2xl border border-surface-highest bg-surface-low p-6 text-center text-sm text-on-surface-variant">Belum ada testimoni.</p>
        @else
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($testimonies as $testimony)
                    <x-testimony-card :testimony="$testimony" />
                @endforeach
            </div>
        @endif
    </section>

    <section class="mx-auto max-w-6xl px-4 pb-24 sm:px-6 lg:px-8">
        <div class="relative overflow-hidden rounded-3xl border border-surface-highest bg-gradient-to-br from-blue-600 via-indigo-600 to-cyan-500 p-8 text-center shadow-2xl sm:p-12">
            <div class="grid-pattern pointer-events-none absolute inset-0 opacity-25"></div>
            <div class="relative z-10 mx-auto max-w-2xl">
                <span class="mb-4 inline-flex items-center gap-1.5 rounded-full border border-white/30 bg-white/10 px-3 py-1 font-mono text-[11px] font-medium text-white">
                    <span class="size-1.5 animate-pulse rounded-full bg-emerald-300"></span>
                    Terbuka untuk peluang baru
                </span>
                <h2 class="text-2xl font-extrabold tracking-tight text-white sm:text-3xl">Tertarik berkolaborasi atau ingin mengenal saya lebih jauh?</h2>
                <p class="mt-3 text-sm leading-relaxed text-white/85 sm:text-base">Saya selalu antusias berdiskusi seputar pengembangan web, mobile, maupun IoT. Kirim pesan, kesan, atau tawaran kolaborasi melalui halaman kontak.</p>
                <div class="mt-7 flex flex-wrap items-center justify-center gap-3">
                    <a href="{{ route('contact') }}" class="flex items-center gap-2 rounded-full bg-white px-6 py-3 text-sm font-semibold text-blue-700 shadow-lg transition-transform hover:-translate-y-0.5">
                        <x-icon name="send" class="size-4" />
                        Hubungi Saya
                    </a>
                    @if ($profile->cv_url)
                        <a href="{{ $profile->cv_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 rounded-full border border-white/40 bg-white/10 px-6 py-3 text-sm font-semibold text-white transition-transform hover:-translate-y-0.5">
                            <x-icon name="download" class="size-4" />
                            Unduh CV
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
