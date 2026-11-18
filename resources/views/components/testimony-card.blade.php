@props([
    'testimony',
])

@php
    $accent = $testimony->role->accentClasses();
@endphp

<article class="group relative flex h-full flex-col overflow-hidden rounded-2xl border border-surface-highest bg-surface-low p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-orange-700/40 hover:shadow-lg sm:p-6">
    <div class="pointer-events-none absolute -right-10 -top-10 size-32 rounded-full bg-orange-500/5 blur-2xl transition group-hover:bg-orange-500/10"></div>

    <div class="mb-4 flex items-start justify-between gap-3">
        <span class="flex size-10 shrink-0 items-center justify-center rounded-xl border {{ $accent['icon'] }}">
            <x-icon name="quote" class="size-4" />
        </span>
        <span class="inline-flex items-center gap-1.5 rounded-full border px-2.5 py-1 font-mono text-[10px] font-bold uppercase tracking-wider {{ $accent['badge'] }}">
            <x-icon :name="$testimony->role->icon()" class="size-3" />
            {{ $testimony->role->label() }}
        </span>
    </div>

    <blockquote class="relative flex-grow text-sm italic leading-7 text-on-surface-variant sm:text-base">
        &ldquo;{{ $testimony->message }}&rdquo;
    </blockquote>

    <div class="mt-6 flex items-center gap-3 border-t border-surface-highest pt-4">
        <div class="flex size-11 shrink-0 items-center justify-center rounded-xl border border-orange-700/30 bg-orange-700/10 font-mono text-xs font-bold text-orange-900 dark:text-orange-300">
            {{ $testimony->initials }}
        </div>
        <div class="min-w-0">
            <p class="truncate text-sm font-bold text-heading">{{ $testimony->name }}</p>
            <p class="truncate font-mono text-[11px] text-outline">{{ $testimony->role->label() }}</p>
        </div>
    </div>
</article>
