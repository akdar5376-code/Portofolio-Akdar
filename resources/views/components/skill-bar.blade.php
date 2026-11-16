@props([
    'skill',
])

@php
    $accent = $skill->type->barClasses();
@endphp

<div class="group" data-purpose="skill-bar">
    <div class="mb-2 flex items-center justify-between gap-3">
        <span class="flex items-center gap-2 text-sm font-semibold text-heading">
            <x-icon :name="$skill->icon ?: 'code'" class="size-4 {{ $accent['text'] }}" />
            {{ $skill->name }}
        </span>
        <span class="font-mono text-xs font-semibold {{ $accent['text'] }}">{{ $skill->percentage }}%</span>
    </div>
    <div class="h-2.5 w-full overflow-hidden rounded-full bg-surface-high">
        <div
            class="skill-bar-fill h-full rounded-full {{ $accent['bar'] }}"
            style="--bar-target: {{ (int) $skill->percentage }}%"
            role="progressbar"
            aria-valuenow="{{ $skill->percentage }}"
            aria-valuemin="0"
            aria-valuemax="100"
            aria-label="{{ $skill->name }}"
        ></div>
    </div>
</div>
