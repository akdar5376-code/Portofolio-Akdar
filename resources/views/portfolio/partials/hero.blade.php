<section class="hero-gradient relative overflow-hidden px-4 pb-28 pt-24 text-white sm:px-6 sm:pb-32 lg:px-8" data-purpose="hero-identity-section" id="home">
    <div class="grid-pattern pointer-events-none absolute inset-0 opacity-80"></div>
    <div class="pointer-events-none absolute left-1/2 top-1/4 h-[360px] w-[580px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-indigo-600/20 blur-[130px]"></div>
    <div class="pointer-events-none absolute bottom-10 right-10 size-96 rounded-full bg-cyan-600/10 blur-[110px]"></div>

    <div class="relative z-10 mx-auto flex max-w-4xl flex-col items-center text-center">
        <div class="mb-8 inline-flex items-center gap-2 rounded-full border border-surface-highest bg-surface-low/80 px-3.5 py-1.5 font-mono text-xs text-on-surface-variant backdrop-blur-md">
            <span class="relative flex size-2">
                <span class="absolute inline-flex size-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex size-2 rounded-full bg-emerald-500"></span>
            </span>
            <span>Junior Developer &bull; Open to Projects</span>
        </div>

        <div class="group relative mb-8">
            <div class="absolute -inset-2 rounded-full bg-gradient-to-r from-blue-500/40 via-cyan-400/30 to-indigo-500/40 opacity-75 blur-xl transition duration-700 group-hover:opacity-100"></div>
            <div class="relative flex size-36 items-center justify-center rounded-full bg-gradient-to-b from-blue-400/60 via-surface-highest to-background p-[3px] shadow-2xl sm:size-44">
                <div class="relative flex size-full items-center justify-center overflow-hidden rounded-full border border-surface-highest/70 bg-gradient-to-b from-surface-container to-background">
                    <div class="absolute inset-1.5 rounded-full border border-dashed border-blue-400/25"></div>
                    <x-icon name="user" class="size-14 text-blue-300/80 transition-colors group-hover:text-blue-200 sm:size-16" stroke-width="1.2" />
                    <span class="absolute bottom-2 rounded-full border border-surface-highest bg-surface-lowest/95 px-2.5 py-0.5 font-mono text-[10px] font-medium tracking-wide text-cyan-400">
                        &lt;/&gt;
                    </span>
                </div>
            </div>
        </div>

        <h1 class="mb-4 max-w-3xl text-3xl font-extrabold leading-tight tracking-tight text-white sm:text-5xl md:text-6xl">
            Halo, Saya <span class="bg-gradient-to-r from-blue-400 via-sky-300 to-indigo-300 bg-clip-text text-transparent">Muhammad Akdar</span>
        </h1>

        <div class="mb-4 inline-flex items-center gap-3 rounded-xl border border-surface-highest/80 bg-surface-low/70 px-4 py-1.5 text-sm font-medium text-on-surface backdrop-blur sm:text-base">
            <span>Junior Developer</span>
            <span class="text-blue-400 opacity-60">|</span>
            <span class="text-on-surface-variant">SMKN 2 Banjarmasin</span>
        </div>

        <p class="mb-10 max-w-xl font-sans text-sm font-light italic leading-relaxed text-on-surface-variant/80 sm:text-base">
            &ldquo;Membangun solusi digital melalui kode yang bersih dan efisien.&rdquo;
        </p>

        <div class="flex flex-col items-center justify-center gap-4 sm:flex-row">
            <a
                href="#portfolio"
                class="group flex cursor-pointer items-center gap-2.5 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-3.5 text-sm font-semibold text-white shadow-lg shadow-blue-600/30 transition-all duration-300 hover:-translate-y-0.5 hover:from-blue-500 hover:to-indigo-500 hover:shadow-blue-500/50 active:translate-y-0 sm:text-base"
                data-purpose="cta-view-portfolio"
            >
                <span>Lihat Portofolio</span>
                <x-icon name="arrow-down" class="size-4 transition-transform group-hover:translate-y-0.5" />
            </a>
        </div>
    </div>
</section>
