@props([
    'badge',
    'title',
    'description' => null,
])

<section class="border-b border-surface-highest px-4 py-14 sm:px-6 sm:py-16 lg:px-8">

    <div class="mx-auto max-w-7xl text-center">
        <span class="mb-4 inline-flex items-center gap-2 border-b border-orange-700/40 pb-2 text-xs font-semibold uppercase tracking-widest text-orange-800 dark:text-orange-300">
            <span class="size-1.5 rounded-full bg-orange-700"></span>
            {{ $badge }}
        </span>
        <h1 class="text-3xl font-semibold tracking-tight text-heading sm:text-4xl md:text-5xl">{{ $title }}</h1>
        @if ($description)
            <p class="mx-auto mt-4 max-w-2xl text-sm leading-relaxed text-on-surface-variant sm:text-base">{{ $description }}</p>
        @endif
        {{ $slot }}
    </div>
</section>
