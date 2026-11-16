@extends('layouts.app')

@section('title', $project->title.' | Proyek '.$profile->full_name)
@section('description', \Illuminate\Support\Str::limit($project->description ?: $project->detail, 150))

@section('content')
    @php($categoryType = \App\Enums\ProjectCategory::tryFrom($project->category))
    @php($accent = ($categoryType ?? \App\Enums\ProjectCategory::Web)->accentClasses())

    <section class="relative overflow-hidden border-b border-surface-highest/50 px-4 pb-12 pt-10 sm:px-6 lg:px-8">
        <div class="grid-pattern pointer-events-none absolute inset-0 opacity-60"></div>
        <div class="pointer-events-none absolute -top-24 left-1/2 size-80 -translate-x-1/2 rounded-full bg-blue-500/10 blur-[110px]"></div>

        <div class="relative z-10 mx-auto max-w-5xl">
            <nav class="mb-6 flex flex-wrap items-center gap-1.5 font-mono text-[11px] text-outline" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-blue-600 dark:hover:text-blue-300">Beranda</a>
                <span>/</span>
                <a href="{{ route('projects.index') }}" class="hover:text-blue-600 dark:hover:text-blue-300">Proyek</a>
                <span>/</span>
                <span class="text-on-surface-variant">{{ $project->title }}</span>
            </nav>

            <div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
                <div>
                    <div class="mb-3 flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 rounded-full border px-3 py-1 font-mono text-[10px] font-bold uppercase tracking-wider {{ $accent['badge'] }}">
                            <span class="size-1.5 rounded-full {{ $accent['dot'] }}"></span>
                            {{ $categoryType?->label() ?? $project->category }}
                        </span>
                        @if ($project->is_featured)
                            <span class="inline-flex items-center gap-1 rounded-full border border-amber-500/30 bg-amber-500/10 px-2.5 py-1 font-mono text-[10px] font-bold uppercase tracking-wider text-amber-600 dark:text-amber-300">
                                <x-icon name="star" class="size-3" />
                                Proyek Unggulan
                            </span>
                        @endif
                    </div>

                    <h1 class="text-3xl font-extrabold leading-tight tracking-tight text-heading sm:text-4xl">{{ $project->title }}</h1>
                    <p class="mt-4 text-sm leading-relaxed text-on-surface-variant sm:text-base">{{ $project->description }}</p>

                    @if ($project->role)
                        <p class="mt-4 flex items-center gap-2 text-sm text-on-surface-variant">
                            <x-icon name="user" class="size-4 text-blue-500" />
                            Peran: <span class="font-semibold text-heading">{{ $project->role }}</span>
                        </p>
                    @endif

                    <div class="mt-6 flex flex-wrap items-center gap-2">
                        @if ($project->project_url)
                            <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 rounded-full bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-600/25 transition-colors hover:bg-blue-500">
                                <x-icon name="external-link" class="size-4" />
                                Live Demo
                            </a>
                        @endif
                        @if ($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 rounded-full border border-surface-highest bg-surface-low px-5 py-2.5 text-sm font-semibold text-on-surface transition-colors hover:border-blue-500/40">
                                <x-icon name="github" class="size-4" />
                                Source Code
                            </a>
                        @endif
                        <a href="{{ route('projects.index') }}" class="flex items-center gap-2 rounded-full border border-surface-highest bg-transparent px-5 py-2.5 text-sm font-semibold text-on-surface-variant transition-colors hover:text-heading">
                            <x-icon name="arrow-left" class="size-4" />
                            Kembali
                        </a>
                    </div>
                </div>

                <div class="relative">
                    <div class="absolute -inset-3 rounded-3xl bg-gradient-to-tr from-blue-500/15 to-cyan-500/15 blur-2xl"></div>
                    <div class="relative overflow-hidden rounded-2xl border border-surface-highest bg-surface-low shadow-2xl">
                        <img src="{{ $project->thumbnail_url }}" alt="Tangkapan layar proyek {{ $project->title }}" class="aspect-video w-full object-contain">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-5xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="grid gap-6 lg:grid-cols-[1fr_300px]">
            <div class="space-y-6">
                @if ($project->detail)
                    <div class="rounded-2xl border border-surface-highest bg-surface-low p-6 shadow-card-dark sm:p-8">
                        <h2 class="mb-3 flex items-center gap-2 text-lg font-bold text-heading">
                            <x-icon name="file-text" class="size-5 text-blue-500" />
                            Detail Proyek
                        </h2>
                        <p class="whitespace-pre-line text-sm leading-relaxed text-on-surface-variant">{{ $project->detail }}</p>
                    </div>
                @endif

                <div class="grid gap-5 sm:grid-cols-2">
                    <div class="rounded-2xl border border-rose-500/20 bg-rose-500/5 p-6">
                        <h2 class="mb-2 flex items-center gap-2 text-sm font-bold text-rose-600 dark:text-rose-300">
                            <x-icon name="target" class="size-4" />
                            Permasalahan
                        </h2>
                        <p class="text-sm leading-relaxed text-on-surface-variant">{{ $project->problem ?: 'Belum diisi.' }}</p>
                    </div>
                    <div class="rounded-2xl border border-emerald-500/20 bg-emerald-500/5 p-6">
                        <h2 class="mb-2 flex items-center gap-2 text-sm font-bold text-emerald-600 dark:text-emerald-300">
                            <x-icon name="compass" class="size-4" />
                            Tujuan
                        </h2>
                        <p class="text-sm leading-relaxed text-on-surface-variant">{{ $project->goal ?: 'Belum diisi.' }}</p>
                    </div>
                </div>

                @if (count($project->feature_list))
                    <div class="rounded-2xl border border-surface-highest bg-surface-low p-6 shadow-card-dark sm:p-8">
                        <h2 class="mb-4 flex items-center gap-2 text-lg font-bold text-heading">
                            <x-icon name="sparkles" class="size-5 text-cyan-500" />
                            Fitur Utama
                        </h2>
                        <ul class="grid gap-2.5 sm:grid-cols-2">
                            @foreach ($project->feature_list as $feature)
                                <li class="flex items-start gap-2 text-sm text-on-surface-variant">
                                    <x-icon name="check-circle" class="mt-0.5 size-4 shrink-0 text-emerald-500" />
                                    <span>{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (count($project->process_steps))
                    <div class="rounded-2xl border border-surface-highest bg-surface-low p-6 shadow-card-dark sm:p-8">
                        <h2 class="mb-4 flex items-center gap-2 text-lg font-bold text-heading">
                            <x-icon name="wrench" class="size-5 text-indigo-500" />
                            Dokumentasi Proses Pekerjaan
                        </h2>
                        <ol class="relative space-y-4 border-l border-surface-highest pl-6">
                            @foreach ($project->process_steps as $index => $step)
                                <li class="relative">
                                    <span class="absolute -left-[30px] flex size-4 items-center justify-center rounded-full border-2 border-background bg-blue-500 font-mono text-[8px] font-bold text-white">{{ $index + 1 }}</span>
                                    <p class="text-sm leading-relaxed text-on-surface-variant">{{ $step }}</p>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                @endif

                @if ($project->user_feedback)
                    <div class="relative overflow-hidden rounded-2xl border border-blue-500/30 bg-gradient-to-br from-blue-600/10 via-surface-low to-cyan-500/10 p-6 sm:p-8">
                        <x-icon name="quote" class="mb-3 size-7 text-blue-500/60" />
                        <h2 class="mb-2 text-sm font-bold uppercase tracking-wider text-blue-600 dark:text-blue-300">Feedback Pengguna</h2>
                        <blockquote class="text-sm italic leading-relaxed text-on-surface-variant sm:text-base">
                            &ldquo;{{ $project->user_feedback }}&rdquo;
                        </blockquote>
                    </div>
                @endif

                <div class="flex items-center justify-between rounded-2xl border border-surface-highest bg-surface-low p-5">
                    <a href="{{ route('projects.index') }}" class="flex items-center gap-2 text-sm font-semibold text-on-surface-variant hover:text-blue-600 dark:hover:text-blue-300">
                        <x-icon name="arrow-left" class="size-4" />
                        Kembali ke galeri
                    </a>
                    <a href="#" data-scroll-top class="flex items-center gap-2 text-sm font-semibold text-on-surface-variant hover:text-blue-600 dark:hover:text-blue-300">
                        Ke atas
                        <x-icon name="arrow-up" class="size-4" />
                    </a>
                </div>
            </div>

            <aside class="space-y-5">
                <div class="rounded-2xl border border-surface-highest bg-surface-low p-5 shadow-card-dark">
                    <h2 class="mb-3 flex items-center gap-2 text-sm font-bold text-heading">
                        <x-icon name="code" class="size-4 text-blue-500" />
                        Teknologi
                    </h2>
                    @if (count($project->tech_stack_list))
                        <div class="flex flex-wrap gap-1.5">
                            @foreach ($project->tech_stack_list as $tech)
                                <span class="rounded-full border border-surface-highest bg-surface-container px-2.5 py-1 font-mono text-[10px] text-on-surface-variant">{{ $tech }}</span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-on-surface-variant">Belum dicantumkan.</p>
                    @endif
                </div>

                <div class="rounded-2xl border border-surface-highest bg-surface-low p-5 shadow-card-dark">
                    <h2 class="mb-3 text-sm font-bold text-heading">Informasi Proyek</h2>
                    <dl class="space-y-3 text-xs">
                        <div>
                            <dt class="font-mono text-[10px] uppercase tracking-widest text-outline">Kategori</dt>
                            <dd class="mt-0.5 font-semibold text-on-surface">{{ $categoryType?->label() ?? $project->category }}</dd>
                        </div>
                        <div>
                            <dt class="font-mono text-[10px] uppercase tracking-widest text-outline">Peran</dt>
                            <dd class="mt-0.5 font-semibold text-on-surface">{{ $project->role ?: 'Belum diisi' }}</dd>
                        </div>
                        <div>
                            <dt class="font-mono text-[10px] uppercase tracking-widest text-outline">Terakhir diperbarui</dt>
                            <dd class="mt-0.5 font-semibold text-on-surface">{{ $project->updated_at->translatedFormat('d F Y') }}</dd>
                        </div>
                    </dl>
                </div>

                @if ($project->project_url || $project->github_url)
                    <div class="rounded-2xl border border-surface-highest bg-surface-low p-5 shadow-card-dark">
                        <h2 class="mb-3 text-sm font-bold text-heading">Tautan</h2>
                        <div class="space-y-2">
                            @if ($project->project_url)
                                <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-xs font-semibold text-blue-600 hover:underline dark:text-blue-300">
                                    <x-icon name="external-link" class="size-3.5" />
                                    Demo aplikasi
                                </a>
                            @endif
                            @if ($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-xs font-semibold text-blue-600 hover:underline dark:text-blue-300">
                                    <x-icon name="github" class="size-3.5" />
                                    Source code GitHub
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </aside>
        </div>
    </section>

    @if ($related->isNotEmpty())
        <section class="mx-auto max-w-7xl border-t border-surface-highest/50 px-4 py-16 sm:px-6 lg:px-8">
            <div class="mb-8 flex items-center justify-between">
                <h2 class="text-xl font-extrabold tracking-tight text-heading">Proyek Lainnya</h2>
                <a href="{{ route('projects.index') }}" class="text-xs font-semibold text-blue-600 hover:underline dark:text-blue-300">Lihat semua</a>
            </div>
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($related as $relatedProject)
                    <x-project-card :project="$relatedProject" />
                @endforeach
            </div>
        </section>
    @endif
@endsection
