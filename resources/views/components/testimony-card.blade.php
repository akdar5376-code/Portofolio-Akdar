@props([
    'testimony',
])

@php
    $accent = $testimony->role->accentClasses();
@endphp

<article class="group flex h-full flex-col rounded-2xl border border-surface-highest bg-surface-low p-5 shadow-card-dark transition-all duration-300 hover:-translate-y-1 hover:border-blue-500/40">
    <div class="mb-4 flex items-start justify-between gap-3">
        <span class="flex size-9 shrink-0 items-center justify-center rounded-xl border {{ $accent['icon'] }}">
            <x-icon name="quote" class="size-4" />
        </span>
        <span class="inline-flex items-center gap-1.5 rounded-full border px-2.5 py-1 font-mono text-[10px] font-bold uppercase tracking-wider {{ $accent['badge'] }}">
            <x-icon :name="$testimony->role->icon()" class="size-3" />
            {{ $testimony->role->label() }}
        </span>
    </div>

    <blockquote class="flex-grow text-sm leading-relaxed text-on-surface-variant">
        &ldquo;{{ $testimony->message }}&rdquo;
    </blockquote>

    <div class="mt-5 flex items-center gap-3 border-t border-surface-highest pt-4">
        <div class="flex size-11 shrink-0 items-center justify-center rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 font-mono text-xs font-bold text-white">
            {{ $testimony->initials }}
        </div>
        <div class="min-w-0">
            <p class="truncate text-sm font-bold text-heading">{{ $testimony->name }}</p>
            <p class="truncate font-mono text-[11px] text-outline">{{ $testimony->role->label() }}</p>
        </div>
    </div>
</article>
