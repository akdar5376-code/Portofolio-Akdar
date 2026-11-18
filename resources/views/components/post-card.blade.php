@props([
    'post',
])

@php
    $accent = $post->category->accentClasses();
    $publishedAt = $post->published_at ?? $post->created_at;
@endphp

<article
    {{ $attributes->merge(['class' => 'group flex flex-col overflow-hidden border-y border-surface-highest bg-surface-low transition-colors '.$accent['hover']]) }}
    data-purpose="post-card"
>
    <a href="{{ route('posts.show', $post) }}" class="relative block aspect-video w-full overflow-hidden bg-surface-container">
        <img
            src="{{ $post->cover_url }}"
            alt="Sampul artikel {{ $post->title }}"
            loading="lazy"
            class="h-full w-full object-cover transition-all duration-700 ease-out group-hover:scale-105"
        >

        <div class="absolute left-4 top-4">
            <span class="inline-flex items-center gap-1.5 rounded-full border bg-surface-lowest/95 px-3 py-1 font-mono text-[11px] font-bold uppercase tracking-wider shadow-md backdrop-blur-md {{ $accent['badge'] }}">
                <span class="size-1.5 rounded-full {{ $accent['dot'] }}"></span>
                {{ $post->category->shortLabel() }}
            </span>
        </div>
    </a>

    <div class="flex flex-grow flex-col p-6">
        <div class="mb-3 flex flex-wrap items-center gap-x-3 gap-y-1 font-mono text-[10px] text-outline">
            <span class="inline-flex items-center gap-1">
                <x-icon name="calendar" class="size-3" />
                {{ $publishedAt->translatedFormat('d M Y') }}
            </span>
            <span class="inline-flex items-center gap-1">
                <x-icon name="clock" class="size-3" />
                {{ $post->reading_minutes }} menit baca
            </span>
        </div>

        <div class="flex-grow">
            <h3 class="mb-2 text-xl font-bold tracking-tight text-heading transition-colors {{ $accent['title'] }}">
                <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
            </h3>
            <p class="mb-4 line-clamp-3 text-sm leading-relaxed text-on-surface-variant">
                {{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->body_html), 140) }}
            </p>

            @if (count($post->tag_list))
                <div class="mb-5 flex flex-wrap gap-1.5">
                    @foreach (array_slice($post->tag_list, 0, 3) as $tag)
                        <span class="rounded-full border border-surface-highest bg-surface-container px-2.5 py-1 font-mono text-[10px] text-on-surface-variant">{{ $tag }}</span>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="flex items-center justify-between gap-2 border-t border-surface-high pt-4">
            <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-outline">
                <x-icon :name="$post->category->icon()" class="size-3.5" />
                {{ $post->category->label() }}
            </span>
            <a
                href="{{ route('posts.show', $post) }}"
                class="flex items-center gap-1 bg-orange-800/10 px-3 py-1.5 text-xs font-semibold text-orange-900 transition-colors hover:bg-orange-800 hover:text-white dark:text-orange-300 dark:hover:bg-orange-300 dark:hover:text-stone-950"
            >
                Baca
                <x-icon name="arrow-right" class="size-3.5" />
            </a>
        </div>
    </div>
</article>
