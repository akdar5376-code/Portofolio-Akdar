@props([
    'badge',
    'title',
    'description' => null,
])

<section class="relative overflow-hidden border-b border-surface-highest/50 px-4 pb-14 pt-16 sm:px-6 sm:pb-16 sm:pt-20 lg:px-8">
    <div class="grid-pattern pointer-events-none absolute inset-0 opacity-70"></div>
    <div class="pointer-events-none absolute -top-24 left-1/3 size-72 rounded-full bg-blue-500/10 blur-[100px]"></div>
    <div class="pointer-events-none absolute -right-10 top-10 size-64 rounded-full bg-cyan-500/10 blur-[100px]"></div>

    <div class="relative z-10 mx-auto max-w-4xl text-center">
        <span class="mb-4 inline-flex items-center gap-2 rounded-full border border-blue-500/30 bg-blue-500/10 px-3.5 py-1.5 font-mono text-[11px] font-semibold uppercase tracking-widest text-blue-600 dark:text-blue-300">
            <span class="size-1.5 animate-pulse rounded-full bg-blue-500"></span>
            {{ $badge }}
        </span>
        <h1 class="text-3xl font-extrabold tracking-tight text-heading sm:text-4xl md:text-5xl">{{ $title }}</h1>
        @if ($description)
            <p class="mx-auto mt-4 max-w-2xl text-sm leading-relaxed text-on-surface-variant sm:text-base">{{ $description }}</p>
        @endif
        {{ $slot }}
    </div>
</section>
