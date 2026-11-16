@extends('layouts.app')

@section('title', 'Galeri Proyek | '.$profile->full_name)
@section('description', 'Kumpulan proyek web, mobile, dan IoT karya '.$profile->full_name.'.')

@section('content')
    <x-page-header
        badge="Portofolio"
        title="Proyek"
        description="Setiap proyek berangkat dari masalah nyata. Jelajahi detail, teknologi, peran, hingga dokumentasi proses pengerjaannya."
    >
        <form method="GET" action="{{ route('projects.index') }}" class="mx-auto mt-6 flex max-w-xl items-center gap-2">
            @if ($activeCategory)
                <input type="hidden" name="category" value="{{ $activeCategory }}">
            @endif
            <div class="relative flex-grow">
                <x-icon name="search" class="absolute left-3.5 top-1/2 size-4 -translate-y-1/2 text-outline" />
                <input
                    type="search"
                    name="q"
                    value="{{ $search }}"
                    placeholder="Cari proyek atau teknologi..."
                    class="w-full rounded-full border border-surface-highest bg-surface-low py-2.5 pl-10 pr-4 text-sm text-on-surface outline-none transition-colors placeholder:text-outline focus:border-blue-500"
                >
            </div>
            <button type="submit" class="rounded-full bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-blue-500">Cari</button>
        </form>
    </x-page-header>

    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-wrap items-center justify-center gap-2">
            <a
                href="{{ route('projects.index', $search !== '' ? ['q' => $search] : []) }}"
                @class([
                    'rounded-full border px-4 py-2 text-xs font-semibold transition-colors',
                    'border-blue-500/40 bg-blue-600 text-white shadow-md shadow-blue-600/20' => $activeCategory === null,
                    'border-surface-highest bg-surface-low text-on-surface-variant hover:text-heading' => $activeCategory !== null,
                ])
            >Semua</a>
            @foreach ($categories as $category)
                <a
                    href="{{ route('projects.index', array_filter(['category' => $category, 'q' => $search])) }}"
                    @class([
                        'rounded-full border px-4 py-2 text-xs font-semibold transition-colors',
                        'border-blue-500/40 bg-blue-600 text-white shadow-md shadow-blue-600/20' => $activeCategory === $category,
                        'border-surface-highest bg-surface-low text-on-surface-variant hover:text-heading' => $activeCategory !== $category,
                    ])
                >{{ \App\Enums\ProjectCategory::tryFrom($category)?->label() ?? $category }}</a>
            @endforeach
        </div>

        @if ($projects->isEmpty())
            <div class="rounded-3xl border border-surface-highest bg-surface-low py-20 text-center">
                <div class="mx-auto mb-4 flex size-16 items-center justify-center rounded-2xl border border-surface-highest bg-surface-high text-blue-500">
                    <x-icon name="folder-off" class="size-8" />
                </div>
                <p class="text-base font-semibold text-heading">Tidak ada proyek yang sesuai kategori ini.</p>
                <p class="mt-1 text-xs text-on-surface-variant">
                    {{ $search !== '' ? 'Coba kata kunci lain atau ubah filter kategori.' : 'Silakan pilih kategori lain.' }}
                </p>
                <a href="{{ route('projects.index') }}" class="mt-5 inline-flex items-center gap-1.5 rounded-full bg-blue-600 px-4 py-2 text-xs font-semibold text-white">Reset filter</a>
            </div>
        @else
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($projects as $project)
                    <x-project-card :project="$project" />
                @endforeach
            </div>
        @endif
    </section>
@endsection
