@extends('layouts.admin-app')

@section('title', 'Kelola Proyek')
@section('heading', 'Kelola Proyek')

@section('content')
    @php($categoryCount = $projects->pluck('category')->filter()->unique()->count())

    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div>
            <h2 class="text-xl font-extrabold tracking-tight text-heading sm:text-2xl">Galeri Proyek</h2>
            <p class="mt-1 text-sm text-on-surface-variant">Tambah, ubah, dan hapus proyek yang tampil di galeri publik.</p>
        </div>
        @if ($editing)
            <a href="{{ route('admin.projects.index') }}" class="flex items-center justify-center gap-2 rounded-full border border-surface-highest bg-surface-low px-4 py-2.5 text-xs font-semibold text-on-surface transition-colors hover:border-orange-500/40">
                <x-icon name="plus" class="size-4" />
                Tambah Proyek Baru
            </a>
        @endif
    </div>

    <div class="mb-6 grid gap-3 sm:grid-cols-3">
        <div class="rounded-xl border border-surface-highest bg-surface-low p-4">
            <p class="font-mono text-[10px] uppercase tracking-widest text-outline">Total Proyek</p>
            <p class="mt-1 text-2xl font-extrabold text-heading">{{ $counts['total'] }}</p>
        </div>
        <div class="rounded-xl border border-surface-highest bg-surface-low p-4">
            <p class="font-mono text-[10px] uppercase tracking-widest text-outline">Proyek Unggulan</p>
            <p class="mt-1 text-2xl font-extrabold text-heading">{{ $counts['featured'] }}</p>
        </div>
        <div class="rounded-xl border border-surface-highest bg-surface-low p-4">
            <p class="font-mono text-[10px] uppercase tracking-widest text-outline">Total Kategori</p>
            <p class="mt-1 text-2xl font-extrabold text-heading">{{ $categoryCount }}</p>
        </div>
    </div>

    <div class="grid min-w-0 items-start gap-4 sm:gap-6 xl:grid-cols-[minmax(0,460px)_1fr]">
        <section id="form" class="min-w-0 rounded-lg border border-surface-highest bg-surface-low p-4 shadow-sm sm:p-6">
            <div class="mb-5 flex items-center justify-between border-b border-surface-highest pb-4">
                <div>
                    <h2 class="flex items-center gap-2 text-base font-bold text-heading">
                        <x-icon :name="$editing ? 'edit' : 'plus-circle'" class="size-4 text-orange-500" />
                        {{ $editing ? 'Edit Project' : 'Tambah Proyek Baru' }}
                    </h2>
                    <p class="mt-1 text-xs text-on-surface-variant">{{ $editing ? 'Perbarui data proyek lalu simpan.' : 'Isi data proyek untuk dipublikasikan.' }}</p>
                </div>
            </div>

            @include('admin.projects.partials.form')
        </section>

        <section class="min-w-0 rounded-lg border border-surface-highest bg-surface-low p-4 shadow-sm sm:p-6">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="flex items-center gap-2 text-base font-bold text-heading">
                    <x-icon name="layers" class="size-4 text-orange-500" />
                    Daftar Proyek
                </h2>
                <span class="rounded-full border border-surface-highest bg-surface-container px-2.5 py-1 font-mono text-[10px] text-on-surface-variant">{{ $counts['total'] }} proyek</span>
            </div>

            <div class="overflow-x-auto rounded-xl border border-surface-highest">
                <table class="w-full border-collapse text-left">
                    <thead class="border-b border-surface-highest bg-surface-container/60 font-mono text-[10px] uppercase tracking-wider text-outline">
                        <tr>
                            <th scope="col" class="px-4 py-3">Proyek</th>
                            <th scope="col" class="hidden px-4 py-3 sm:table-cell">Kategori</th>
                            <th scope="col" class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-highest text-sm">
                        @forelse ($projects as $project)
                            <tr class="transition-colors hover:bg-surface-container/40">
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }}" class="h-10 w-16 shrink-0 rounded-lg border border-surface-highest object-cover">
                                        <div class="min-w-0">
                                            <p class="truncate text-sm font-semibold text-heading">{{ $project->title }}</p>
                                            <p class="truncate font-mono text-[10px] text-outline">{{ $project->role ?: 'Tanpa peran' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="hidden px-4 py-3 sm:table-cell">
                                    <span class="rounded-full border border-surface-highest bg-surface-container px-2 py-0.5 font-mono text-[10px] text-on-surface-variant">{{ $project->category }}</span>
                                    @if ($project->is_featured)
                                        <span class="ml-1 rounded-full bg-amber-500/10 px-2 py-0.5 font-mono text-[9px] font-bold uppercase text-amber-600 dark:text-amber-300">Unggulan</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('admin.projects.index', ['edit' => $project->id]) }}#form" class="flex size-8 items-center justify-center rounded-lg text-on-surface-variant transition-colors hover:bg-surface-high hover:text-heading" title="Edit proyek">
                                            <x-icon name="edit" class="size-4" />
                                        </a>
                                        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" data-confirm="Hapus proyek ini dari galeri?">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="flex size-8 cursor-pointer items-center justify-center rounded-lg text-on-surface-variant transition-colors hover:bg-red-500/10 hover:text-red-500" title="Hapus proyek">
                                                <x-icon name="trash" class="size-4" />
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-12 text-center">
                                    <x-icon name="folder-off" class="mx-auto mb-2 size-8 text-outline" />
                                    <p class="text-sm font-semibold text-heading">Belum ada proyek.</p>
                                    <p class="mt-1 text-xs text-on-surface-variant">Tambahkan proyek pertama lewat form.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
