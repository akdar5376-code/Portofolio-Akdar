@props([
    'skill',
    'iconClass' => 'size-4',
])

@php
    $skillLogoGroups = [
        'html & css' => ['html5', 'css3'],
        'javascript' => ['javascript'],
        'php & laravel' => ['php', 'laravel'],
        'tailwind css' => ['tailwind'],
        'mysql' => ['mysql'],
        'flutter' => ['flutter'],
        'git & github' => ['git', 'github'],
        'ui/ux design' => ['figma'],
    ];
    $skillName = mb_strtolower(trim($skill->name));
    $storedIconNames = collect(explode(',', (string) $skill->icon))
        ->map(fn (string $iconName): string => trim($iconName))
        ->filter();
    $iconNames = isset($skillLogoGroups[$skillName]) && $storedIconNames->count() <= 1
        ? $skillLogoGroups[$skillName]
        : ($storedIconNames->isNotEmpty() ? $storedIconNames : collect(['code']));
@endphp

<span class="inline-flex shrink-0 items-center gap-0.5">
    @foreach ($iconNames as $iconName)
        <x-icon :name="$iconName" :class="$iconClass" />
    @endforeach
</span>
