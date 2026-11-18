@extends('layouts.admin-app')

@section('title', 'Kelola Blog')
@section('heading', 'Kelola Blog')

@section('content')
    @php
        $categoryOptions = collect(\App\Enums\PostCategory::cases())->mapWithKeys(fn ($category) => [$category->value => $category->label()]);
    @endphp

    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div>
            <h2 class="text-2xl font-extrabold tracking-tight text-heading">Blog Pengembang</h2>
            <p class="mt-1 text-sm text-on-surface-variant">Tulis artikel, tutorial, dan catatan ngoding yang tampil di blog publik.</p>
        </div>
        @if ($editing)
            <a href="{{ route('admin.posts.index') }}" class="flex items-center justify-center gap-2 rounded-full border border-surface-highest bg-surface-low px-4 py-2.5 text-xs font-semibold text-on-surface transition-colors hover:border-orange-500/40">
                <x-icon name="plus" class="size-4" />
                Tulis Artikel Baru
            </a>
        @endif
    </div>

    <div class="mb-6 grid gap-3 sm:grid-cols-3">
        <div class="rounded-xl border border-surface-highest bg-surface-low p-4">
            <p class="font-mono text-[10px] uppercase tracking-widest text-outline">Total Artikel</p>
            <p class="mt-1 text-2xl font-extrabold text-heading">{{ $counts['total'] }}</p>
        </div>
        <div class="rounded-xl border border-surface-highest bg-surface-low p-4">
            <p class="font-mono text-[10px] uppercase tracking-widest text-outline">Terbit</p>
            <p class="mt-1 text-2xl font-extrabold text-emerald-500">{{ $counts['published'] }}</p>
        </div>
        <div class="rounded-xl border border-surface-highest bg-surface-low p-4">
            <p class="font-mono text-[10px] uppercase tracking-widest text-outline">Draf</p>
            <p class="mt-1 text-2xl font-extrabold text-amber-500">{{ $counts['drafts'] }}</p>
        </div>
    </div>

    <div class="grid items-start gap-6 xl:grid-cols-[minmax(0,520px)_1fr]">
        <section id="form" class="rounded-lg border border-surface-highest bg-surface-low p-5 shadow-sm sm:p-6">
            <div class="mb-5 flex items-center justify-between border-b border-surface-highest pb-4">
                <div>
                    <h2 class="flex items-center gap-2 text-base font-bold text-heading">
                        <x-icon :name="$editing ? 'edit' : 'plus-circle'" class="size-4 text-orange-500" />
                        {{ $editing ? 'Edit Artikel' : 'Tulis Artikel Baru' }}
                    </h2>
                    <p class="mt-1 text-xs text-on-surface-variant">{{ $editing ? 'Perbarui tulisan lalu simpan perubahan.' : 'Isi tulisan untuk dipublikasikan ke blog.' }}</p>
                </div>
            </div>

            @include('admin.posts.partials.form')
        </section>

        <section class="rounded-lg border border-surface-highest bg-surface-low p-5 shadow-sm sm:p-6">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="flex items-center gap-2 text-base font-bold text-heading">
                    <x-icon name="file-text" class="size-4 text-orange-500" />
                    Daftar Artikel
                </h2>
                <span class="rounded-full border border-surface-highest bg-surface-container px-2.5 py-1 font-mono text-[10px] text-on-surface-variant">{{ $counts['total'] }} artikel</span>
            </div>

            <div class="overflow-x-auto rounded-xl border border-surface-highest">
                <table class="w-full border-collapse text-left">
                    <thead class="border-b border-surface-highest bg-surface-container/60 font-mono text-[10px] uppercase tracking-wider text-outline">
                        <tr>
                            <th scope="col" class="px-4 py-3">Artikel</th>
                            <th scope="col" class="hidden px-4 py-3 md:table-cell">Status</th>
                            <th scope="col" class="hidden px-4 py-3 sm:table-cell">Terbit</th>
                            <th scope="col" class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-highest text-sm">
                        @forelse ($posts as $post)
                            @php
                                $isScheduled = $post->is_published && $post->published_at?->isFuture();
                            @endphp
                            <tr class="transition-colors hover:bg-surface-container/40">
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $post->cover_url }}" alt="{{ $post->title }}" class="h-10 w-16 shrink-0 rounded-lg border border-surface-highest object-cover">
                                        <div class="min-w-0">
                                            <p class="truncate text-sm font-semibold text-heading">{{ $post->title }}</p>
                                            <p class="truncate font-mono text-[10px] text-outline">{{ $post->category->shortLabel() }} &middot; {{ $post->reading_minutes }} menit baca</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="hidden px-4 py-3 md:table-cell">
                                    @if (! $post->is_published)
                                        <span class="rounded-full bg-amber-500/10 px-2 py-0.5 font-mono text-[9px] font-bold uppercase text-amber-600 dark:text-amber-300">Draf</span>
                                    @elseif ($isScheduled)
                                        <span class="rounded-full bg-orange-500/10 px-2 py-0.5 font-mono text-[9px] font-bold uppercase text-orange-600 dark:text-orange-300">Jadwal</span>
                                    @else
                                        <span class="rounded-full bg-emerald-500/10 px-2 py-0.5 font-mono text-[9px] font-bold uppercase text-emerald-600 dark:text-emerald-300">Terbit</span>
                                    @endif
                                </td>
                                <td class="hidden px-4 py-3 font-mono text-[10px] text-on-surface-variant sm:table-cell">
                                    {{ $post->published_at?->translatedFormat('d M Y H:i') ?? 'Belum diterbitkan' }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end gap-1.5">
                                        @if ($post->isVisible())
                                            <a href="{{ route('posts.show', $post) }}" target="_blank" rel="noopener noreferrer" class="flex size-8 items-center justify-center rounded-lg text-on-surface-variant transition-colors hover:bg-surface-high hover:text-heading" title="Lihat artikel">
                                                <x-icon name="external-link" class="size-4" />
                                            </a>
                                        @endif
                                        <a href="{{ route('admin.posts.index', ['edit' => $post->id]) }}#form" class="flex size-8 items-center justify-center rounded-lg text-on-surface-variant transition-colors hover:bg-surface-high hover:text-heading" title="Edit artikel">
                                            <x-icon name="edit" class="size-4" />
                                        </a>
                                        <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" data-confirm="Hapus artikel ini dari blog?">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="flex size-8 cursor-pointer items-center justify-center rounded-lg text-on-surface-variant transition-colors hover:bg-red-500/10 hover:text-red-500" title="Hapus artikel">
                                                <x-icon name="trash" class="size-4" />
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-12 text-center">
                                    <x-icon name="file-text" class="mx-auto mb-2 size-8 text-outline" />
                                    <p class="text-sm font-semibold text-heading">Belum ada artikel.</p>
                                    <p class="mt-1 text-xs text-on-surface-variant">Tulis artikel pertama lewat form.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
