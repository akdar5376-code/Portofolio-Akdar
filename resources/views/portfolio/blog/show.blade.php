@extends('layouts.app')

@section('title', $post->title.' | Blog '.$profile->full_name)
@section('description', \Illuminate\Support\Str::limit($post->excerpt ?: strip_tags($post->body_html), 150))

@section('content')
    @php($accent = $post->category->accentClasses())
    @php($publishedAt = $post->published_at ?? $post->created_at)

    <section class="relative overflow-hidden border-b border-surface-highest/50 px-4 pb-12 pt-10 sm:px-6 lg:px-8">
        <div class="grid-pattern pointer-events-none absolute inset-0 opacity-60"></div>
        <div class="pointer-events-none absolute -top-24 left-1/2 size-80 -translate-x-1/2 rounded-full bg-blue-500/10 blur-[110px]"></div>

        <div class="relative z-10 mx-auto max-w-5xl">
            <nav class="mb-6 flex flex-wrap items-center gap-1.5 font-mono text-[11px] text-outline" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-blue-600 dark:hover:text-blue-300">Beranda</a>
                <span>/</span>
                <a href="{{ route('posts.index') }}" class="hover:text-blue-600 dark:hover:text-blue-300">Blog</a>
                <span>/</span>
                <span class="line-clamp-1 text-on-surface-variant">{{ $post->title }}</span>
            </nav>

            <div class="mx-auto max-w-3xl text-center">
                <span class="mb-4 inline-flex items-center gap-1.5 rounded-full border px-3 py-1 font-mono text-[10px] font-bold uppercase tracking-wider {{ $accent['badge'] }}">
                    <span class="size-1.5 rounded-full {{ $accent['dot'] }}"></span>
                    {{ $post->category->label() }}
                </span>

                <h1 class="text-3xl font-extrabold leading-tight tracking-tight text-heading sm:text-4xl">{{ $post->title }}</h1>

                @if ($post->excerpt)
                    <p class="mx-auto mt-4 max-w-2xl text-sm leading-relaxed text-on-surface-variant sm:text-base">{{ $post->excerpt }}</p>
                @endif

                <div class="mt-6 flex flex-wrap items-center justify-center gap-x-4 gap-y-2 font-mono text-[11px] text-outline">
                    <span class="inline-flex items-center gap-1.5">
                        <x-icon name="user" class="size-3.5" />
                        {{ $profile->full_name }}
                    </span>
                    <span class="inline-flex items-center gap-1.5">
                        <x-icon name="calendar" class="size-3.5" />
                        {{ $publishedAt->translatedFormat('d F Y') }}
                    </span>
                    <span class="inline-flex items-center gap-1.5">
                        <x-icon name="clock" class="size-3.5" />
                        {{ $post->reading_minutes }} menit baca
                    </span>
                </div>
            </div>

            <div class="relative mx-auto mt-10 max-w-4xl">
                <div class="absolute -inset-3 rounded-3xl bg-gradient-to-tr from-blue-500/15 to-cyan-500/15 blur-2xl"></div>
                <div class="relative overflow-hidden rounded-2xl border border-surface-highest bg-surface-low shadow-2xl">
                    <img src="{{ $post->cover_url }}" alt="Sampul artikel {{ $post->title }}" class="aspect-video w-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-5xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="grid gap-6 lg:grid-cols-[1fr_280px]">
            <div class="space-y-6">
                <article class="blog-content rounded-2xl border border-surface-highest bg-surface-low p-6 shadow-card-dark sm:p-8">
                    {!! $post->body_html !!}
                </article>

                <div class="flex items-center justify-between rounded-2xl border border-surface-highest bg-surface-low p-5">
                    <a href="{{ route('posts.index') }}" class="flex items-center gap-2 text-sm font-semibold text-on-surface-variant hover:text-blue-600 dark:hover:text-blue-300">
                        <x-icon name="arrow-left" class="size-4" />
                        Kembali ke blog
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
                        <x-icon name="tag" class="size-4 text-blue-500" />
                        Tag
                    </h2>
                    @if (count($post->tag_list))
                        <div class="flex flex-wrap gap-1.5">
                            @foreach ($post->tag_list as $tag)
                                <a href="{{ route('posts.index', ['q' => $tag]) }}" class="rounded-full border border-surface-highest bg-surface-container px-2.5 py-1 font-mono text-[10px] text-on-surface-variant transition-colors hover:border-blue-500/40 hover:text-blue-600 dark:hover:text-blue-300">#{{ $tag }}</a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-on-surface-variant">Belum ada tag.</p>
                    @endif
                </div>

                <div class="rounded-2xl border border-surface-highest bg-surface-low p-5 shadow-card-dark">
                    <h2 class="mb-3 text-sm font-bold text-heading">Informasi Tulisan</h2>
                    <dl class="space-y-3 text-xs">
                        <div>
                            <dt class="font-mono text-[10px] uppercase tracking-widest text-outline">Kategori</dt>
                            <dd class="mt-0.5 font-semibold text-on-surface">{{ $post->category->label() }}</dd>
                        </div>
                        <div>
                            <dt class="font-mono text-[10px] uppercase tracking-widest text-outline">Terbit</dt>
                            <dd class="mt-0.5 font-semibold text-on-surface">{{ $publishedAt->translatedFormat('d F Y') }}</dd>
                        </div>
                        <div>
                            <dt class="font-mono text-[10px] uppercase tracking-widest text-outline">Terakhir diperbarui</dt>
                            <dd class="mt-0.5 font-semibold text-on-surface">{{ $post->updated_at->translatedFormat('d F Y') }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="relative overflow-hidden rounded-2xl border border-blue-500/30 bg-gradient-to-br from-blue-600/10 via-surface-low to-cyan-500/10 p-5">
                    <x-icon name="terminal" class="mb-2 size-6 text-blue-500/70" />
                    <p class="text-sm font-semibold text-heading">Punya pertanyaan?</p>
                    <p class="mt-1 text-xs leading-relaxed text-on-surface-variant">Diskusikan topik ini lewat halaman kontak atau GitHub.</p>
                    <a href="{{ route('contact') }}" class="mt-3 inline-flex items-center gap-1.5 text-xs font-semibold text-blue-600 hover:underline dark:text-blue-300">
                        Hubungi saya
                        <x-icon name="arrow-up-right" class="size-3.5" />
                    </a>
                </div>
            </aside>
        </div>
    </section>

    @if ($related->isNotEmpty())
        <section class="mx-auto max-w-7xl border-t border-surface-highest/50 px-4 py-16 sm:px-6 lg:px-8">
            <div class="mb-8 flex items-center justify-between">
                <h2 class="text-xl font-extrabold tracking-tight text-heading">Tulisan Lainnya</h2>
                <a href="{{ route('posts.index') }}" class="text-xs font-semibold text-blue-600 hover:underline dark:text-blue-300">Lihat semua</a>
            </div>
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($related as $relatedPost)
                    <x-post-card :post="$relatedPost" />
                @endforeach
            </div>
        </section>
    @endif
@endsection
