@props([
    'experience',
])

@php
    $accent = $experience->type->accentClasses();
@endphp

<article class="relative flex gap-4 border-t border-surface-highest py-5 transition-colors hover:border-orange-700">
    <div class="flex size-11 shrink-0 items-center justify-center rounded-xl border {{ $accent['icon'] }}">
        <x-icon :name="$experience->type->icon()" class="size-5" />
    </div>

    <div class="min-w-0 flex-grow">
        <div class="mb-1.5 flex flex-wrap items-center gap-2">
            <span class="rounded-full border px-2.5 py-0.5 font-mono text-[10px] font-bold uppercase tracking-wider {{ $accent['badge'] }}">
                {{ $experience->type->shortLabel() }}
            </span>
            @if ($experience->period)
                <span class="flex items-center gap-1 font-mono text-[11px] text-outline">
                    <x-icon name="calendar" class="size-3" />
                    {{ $experience->period }}
                </span>
            @endif
        </div>

        <h3 class="text-base font-bold tracking-tight text-heading">{{ $experience->title }}</h3>
        @if ($experience->organization)
            <p class="mt-0.5 text-xs font-semibold text-orange-600 dark:text-orange-300">{{ $experience->organization }}</p>
        @endif
        @if ($experience->description)
            <p class="mt-2 text-sm leading-relaxed text-on-surface-variant">{{ $experience->description }}</p>
        @endif
    </div>
</article>
