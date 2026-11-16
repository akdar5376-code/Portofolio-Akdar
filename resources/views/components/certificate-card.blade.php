@props([
    'certificate',
])

<article class="group flex flex-col overflow-hidden rounded-2xl border border-surface-highest bg-surface-low shadow-card-dark transition-all duration-300 hover:-translate-y-1 hover:border-blue-500/40">
    <div class="relative aspect-[4/3] overflow-hidden bg-gradient-to-br from-blue-600/20 via-surface-container to-cyan-500/10">
        @if ($certificate->image_url)
            <img
                src="{{ $certificate->image_url }}"
                alt="Dokumentasi sertifikat {{ $certificate->title }}"
                loading="lazy"
                class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"
            >
        @else
            <div class="flex h-full w-full flex-col items-center justify-center gap-3 text-blue-500 dark:text-blue-300">
                <div class="flex size-16 items-center justify-center rounded-2xl border border-blue-500/30 bg-blue-500/10">
                    <x-icon name="award" class="size-8" />
                </div>
                <span class="font-mono text-[11px] uppercase tracking-widest text-outline">Dokumentasi Sertifikat</span>
            </div>
        @endif

        @if ($certificate->year)
            <span class="absolute right-3 top-3 rounded-full border border-surface-highest bg-surface-lowest/95 px-2.5 py-1 font-mono text-[10px] font-bold text-on-surface shadow-sm backdrop-blur">
                {{ $certificate->year }}
            </span>
        @endif
    </div>

    <div class="flex flex-grow flex-col p-5">
        <h3 class="mb-1 text-base font-bold tracking-tight text-heading">{{ $certificate->title }}</h3>
        <p class="mb-3 font-mono text-[11px] uppercase tracking-wide text-blue-600 dark:text-blue-300">{{ $certificate->issuer ?: 'Sertifikat' }}</p>
        @if ($certificate->description)
            <p class="mb-4 line-clamp-3 flex-grow text-xs leading-relaxed text-on-surface-variant">{{ $certificate->description }}</p>
        @endif

        @if ($certificate->credential_url)
            <a
                href="{{ $certificate->credential_url }}"
                target="_blank"
                rel="noopener noreferrer"
                class="mt-auto inline-flex items-center gap-1.5 text-xs font-semibold text-blue-600 hover:underline dark:text-blue-300"
            >
                <x-icon name="external-link" class="size-3.5" />
                Lihat kredensial
            </a>
        @endif
    </div>
</article>
