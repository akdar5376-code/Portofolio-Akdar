<section
    class="relative z-20 mx-auto max-w-7xl border-t border-surface-lowest/70 px-4 py-20 sm:px-6 lg:px-8"
    data-purpose="portfolio-gallery-section"
    id="portfolio"
>
    <div class="pointer-events-none absolute left-1/2 top-10 h-[300px] w-[700px] -translate-x-1/2 rounded-full bg-orange-600/10 blur-[140px]"></div>

    <div class="relative z-10 mx-auto mb-12 max-w-2xl text-center">
        <div class="mb-4 inline-flex items-center gap-2 rounded-full border border-orange-500/30 bg-surface-low px-3.5 py-1 font-mono text-xs font-semibold uppercase tracking-widest text-orange-300 shadow-inner">
            <span class="size-1.5 animate-pulse rounded-full bg-orange-400 shadow-[0_0_8px_#60a5fa]"></span>
            Portfolio Showcase
        </div>
        <h2 class="mb-3 text-3xl font-extrabold tracking-tight text-white sm:text-4xl">My Recent Projects</h2>
        <p class="mx-auto max-w-lg text-sm leading-relaxed text-on-surface-variant sm:text-base">
            Kumpulan karya dan proyek aplikasi yang pernah saya rancang dan kembangkan.
        </p>
    </div>

    @if ($projects->isEmpty())
        <div class="relative z-10 my-8 rounded-3xl border border-surface-highest bg-surface-low/80 py-20 text-center shadow-xl" id="no-projects-message">
            <div class="mx-auto mb-4 flex size-16 items-center justify-center rounded-lg border border-surface-highest bg-surface-high text-orange-400">
                <x-icon name="folder-off" class="size-8" />
            </div>
            <p class="text-base font-semibold text-white">Belum ada proyek yang ditampilkan.</p>
            <p class="mt-1 text-xs text-on-surface-variant">Proyek akan muncul di sini setelah dipublish dari panel admin.</p>
        </div>
    @else
        <div class="relative z-10 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3" data-purpose="projects-list-container">
            @foreach ($projects as $project)
                <x-project-card :project="$project" />
            @endforeach
        </div>
    @endif
</section>
