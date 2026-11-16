@extends('layouts.admin-app')

@section('title', 'Dasbor')
@section('heading', 'Dasbor')

@section('content')
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div>
            <h2 class="text-2xl font-extrabold tracking-tight text-heading">Ringkasan Website</h2>
            <p class="mt-1 text-sm text-on-surface-variant">Kelola seluruh konten portofolio dari satu tempat tanpa mengubah kode.</p>
        </div>
        <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center gap-2 rounded-full bg-blue-600 px-4 py-2.5 text-xs font-semibold text-white transition-colors hover:bg-blue-500">
            <x-icon name="eye" class="size-4" />
            Buka Website
        </a>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ([
            ['label' => 'Proyek', 'value' => $counts['projects'], 'icon' => 'layers', 'route' => 'admin.projects.index', 'accent' => 'blue'],
            ['label' => 'Sertifikat', 'value' => $counts['certificates'], 'icon' => 'award', 'route' => 'admin.certificates.index', 'accent' => 'amber'],
            ['label' => 'Keahlian', 'value' => $counts['skills'], 'icon' => 'zap', 'route' => 'admin.content.index', 'accent' => 'indigo'],
            ['label' => 'Pesan Belum Dibaca', 'value' => $counts['unreadMessages'], 'icon' => 'message-square', 'route' => 'admin.messages.index', 'accent' => 'emerald'],
        ] as $card)
            <a href="{{ route($card['route']) }}" class="group rounded-2xl border border-surface-highest bg-surface-low p-5 shadow-card-dark transition-all hover:-translate-y-0.5 hover:border-blue-500/40">
                <div class="mb-3 flex items-center justify-between">
                    <span class="flex size-10 items-center justify-center rounded-xl border border-blue-500/30 bg-blue-500/10 text-blue-600 dark:text-blue-300">
                        <x-icon :name="$card['icon']" class="size-5" />
                    </span>
                    <x-icon name="arrow-up-right" class="size-4 text-outline transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5" />
                </div>
                <p class="text-3xl font-extrabold text-heading">{{ $card['value'] }}</p>
                <p class="mt-0.5 font-mono text-[10px] uppercase tracking-widest text-outline">{{ $card['label'] }}</p>
            </a>
        @endforeach
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-2">
        <section class="rounded-2xl border border-surface-highest bg-surface-low p-5 shadow-card-dark sm:p-6">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="flex items-center gap-2 text-base font-bold text-heading">
                    <x-icon name="layers" class="size-4 text-blue-500" />
                    Proyek Terbaru
                </h2>
                <a href="{{ route('admin.projects.index') }}" class="text-xs font-semibold text-blue-600 hover:underline dark:text-blue-300">Kelola</a>
            </div>

            <div class="space-y-3">
                @forelse ($recentProjects as $project)
                    <div class="flex items-center gap-3 rounded-xl border border-surface-highest bg-surface-container/40 p-3">
                        <img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }}" class="h-10 w-16 rounded-lg object-cover">
                        <div class="min-w-0 flex-grow">
                            <p class="truncate text-sm font-semibold text-heading">{{ $project->title }}</p>
                            <p class="font-mono text-[10px] text-outline">{{ $project->category }}</p>
                        </div>
                        @if ($project->is_featured)
                            <span class="rounded-full bg-amber-500/10 px-2 py-0.5 font-mono text-[9px] font-bold uppercase text-amber-600 dark:text-amber-300">Unggulan</span>
                        @endif
                    </div>
                @empty
                    <p class="text-sm text-on-surface-variant">Belum ada proyek.</p>
                @endforelse
            </div>
        </section>

        <section class="rounded-2xl border border-surface-highest bg-surface-low p-5 shadow-card-dark sm:p-6">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="flex items-center gap-2 text-base font-bold text-heading">
                    <x-icon name="message-square" class="size-4 text-emerald-500" />
                    Pesan Terbaru
                </h2>
                <a href="{{ route('admin.messages.index') }}" class="text-xs font-semibold text-blue-600 hover:underline dark:text-blue-300">Lihat semua</a>
            </div>

            <div class="space-y-3">
                @forelse ($latestMessages as $message)
                    <div class="rounded-xl border border-surface-highest bg-surface-container/40 p-3">
                        <div class="flex items-center justify-between gap-2">
                            <p class="truncate text-sm font-semibold text-heading">{{ $message->name }}</p>
                            @if (! $message->is_read)
                                <span class="shrink-0 rounded-full bg-red-500/10 px-2 py-0.5 font-mono text-[9px] font-bold uppercase text-red-500">Baru</span>
                            @endif
                        </div>
                        <p class="truncate text-xs text-on-surface-variant">{{ $message->subject ?: 'Tanpa subjek' }}</p>
                        <p class="mt-1 font-mono text-[10px] text-outline">{{ $message->created_at->diffForHumans() }}</p>
                    </div>
                @empty
                    <p class="text-sm text-on-surface-variant">Belum ada pesan masuk.</p>
                @endforelse
            </div>
        </section>
    </div>

    <section class="mt-6 rounded-2xl border border-surface-highest bg-gradient-to-br from-blue-600/10 via-surface-low to-cyan-500/10 p-5 sm:p-6">
        <h2 class="text-base font-bold text-heading">Aksi Cepat</h2>
        <div class="mt-4 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ([
                ['label' => 'Tambah Proyek', 'route' => 'admin.projects.index', 'icon' => 'plus-circle'],
                ['label' => 'Tambah Sertifikat', 'route' => 'admin.certificates.index', 'icon' => 'award'],
                ['label' => 'Kelola Keahlian', 'route' => 'admin.content.index', 'icon' => 'zap'],
                ['label' => 'Edit Profil', 'route' => 'admin.profile.edit', 'icon' => 'user'],
            ] as $action)
                <a href="{{ route($action['route']) }}" class="flex items-center gap-2 rounded-xl border border-surface-highest bg-surface-low px-4 py-3 text-xs font-semibold text-on-surface transition-colors hover:border-blue-500/40 hover:text-blue-600 dark:hover:text-blue-300">
                    <x-icon :name="$action['icon']" class="size-4" />
                    {{ $action['label'] }}
                </a>
            @endforeach
        </div>
    </section>
@endsection
