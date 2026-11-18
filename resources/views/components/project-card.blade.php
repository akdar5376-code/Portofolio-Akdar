@props([
    'project',
])

@php
    $categoryType = \App\Enums\ProjectCategory::tryFrom($project->category);
    $accent = ($categoryType ?? \App\Enums\ProjectCategory::Web)->accentClasses();
@endphp

<article
    {{ $attributes->merge(['class' => 'group flex flex-col overflow-hidden border-y border-surface-highest bg-transparent transition-colors '.$accent['hover']]) }}
    data-category="{{ $project->category }}"
    data-purpose="project-card"
>
    <div class="relative aspect-video w-full overflow-hidden bg-surface-container">
        <img
            src="{{ $project->thumbnail_url }}"
            alt="Tangkapan layar proyek {{ $project->title }}"
            loading="lazy"
            class="h-full w-full object-contain"
        >
        <div class="absolute left-4 top-4">
            <span class="inline-flex items-center gap-1.5 rounded-full border bg-surface-lowest/95 px-3 py-1 font-mono text-[11px] font-bold uppercase tracking-wider shadow-md backdrop-blur-md {{ $accent['badge'] }}">
                <span class="size-1.5 rounded-full {{ $accent['dot'] }}"></span>
                {{ $project->category }}
            </span>
        </div>

        @if ($project->is_featured)
            <div class="absolute right-4 top-4">
                <span class="inline-flex items-center gap-1 rounded-full border border-amber-500/40 bg-amber-500/15 px-2.5 py-1 font-mono text-[10px] font-bold uppercase tracking-wider text-amber-600 backdrop-blur-md dark:text-amber-300">
                    <x-icon name="star" class="size-3" />
                    Unggulan
                </span>
            </div>
        @endif
    </div>

    <div class="flex flex-grow flex-col p-6">
        <div class="flex-grow">
            <h3 class="mb-2 text-xl font-bold tracking-tight text-heading transition-colors {{ $accent['title'] }}">
                {{ $project->title }}
            </h3>
            <p class="mb-4 line-clamp-3 text-sm leading-relaxed text-on-surface-variant">
                {{ $project->description ?: 'Belum ada deskripsi proyek.' }}
            </p>

            @if (count($project->tech_stack_list))
                <div class="mb-5 flex flex-wrap gap-1.5">
                    @foreach (array_slice($project->tech_stack_list, 0, 4) as $tech)
                        <span class="rounded-full border border-surface-highest bg-surface-container px-2.5 py-1 font-mono text-[10px] text-on-surface-variant">{{ $tech }}</span>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="flex items-center justify-between gap-2 border-t border-surface-high pt-4">
            <button
                type="button"
                class="flex cursor-pointer items-center gap-1.5 border border-surface-highest px-3.5 py-1.5 text-xs font-semibold text-on-surface transition-colors hover:border-orange-700 hover:text-orange-800 dark:hover:text-orange-300"
                data-project-preview
                data-title="{{ $project->title }}"
                data-category="{{ $project->category }}"
                data-image="{{ $project->thumbnail_url }}"
                data-description="{{ $project->description }}"
                data-problem="{{ $project->problem }}"
                data-goal="{{ $project->goal }}"
                data-tech="{{ $project->tech_stack }}"
                data-role="{{ $project->role }}"
                data-demo="{{ $project->project_url }}"
                data-github="{{ $project->github_url }}"
                data-detail="{{ route('projects.show', $project) }}"
            >
                <x-icon name="eye" class="size-3.5" />
                <span>Preview</span>
            </button>

            <div class="flex items-center gap-1">
                @if ($project->project_url)
                    <a
                        href="{{ $project->project_url }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex size-8 items-center justify-center text-outline transition-colors hover:text-orange-800 dark:hover:text-orange-300"
                        aria-label="Buka demo {{ $project->title }}"
                    >
                        <x-icon name="external-link" class="size-4" />
                    </a>
                @endif
                <a
                    href="{{ route('projects.show', $project) }}"
                    class="flex items-center gap-1 bg-orange-800/10 px-3 py-1.5 text-xs font-semibold text-orange-900 transition-colors hover:bg-orange-800 hover:text-white dark:text-orange-300 dark:hover:bg-orange-300 dark:hover:text-stone-950"
                >
                    Detail
                    <x-icon name="arrow-right" class="size-3.5" />
                </a>
            </div>
        </div>
    </div>
</article>
