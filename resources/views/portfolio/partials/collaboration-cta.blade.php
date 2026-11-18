<section class="mx-auto max-w-5xl px-4 py-16 sm:px-6 lg:px-8" data-purpose="collaboration-cta">
    <div class="relative overflow-hidden rounded-3xl border border-surface-highest bg-gradient-to-b from-surface-container to-[#0d1527] p-8 text-center shadow-sm sm:p-12">
        <div class="pointer-events-none absolute -top-24 left-1/2 h-48 w-96 -translate-x-1/2 rounded-full bg-orange-500/20 blur-[90px]"></div>

        <div class="relative z-10 mx-auto max-w-2xl">
            <span class="mb-4 inline-flex items-center gap-1.5 rounded-full border border-amber-500/30 bg-amber-950/60 px-3 py-1 font-mono text-xs font-medium text-amber-400">
                <span class="size-1.5 animate-pulse rounded-full bg-amber-400"></span>
                Ready for New Opportunities
            </span>
            <h3 class="mb-4 text-2xl font-extrabold tracking-tight text-white sm:text-3xl">
                Tertarik kolaborasi atau ingin melihat source code lebih lanjut?
            </h3>
            <p class="mb-8 text-sm leading-relaxed text-on-surface-variant sm:text-base">
                Saya selalu antusias berdiskusi seputar peluang pengembangan aplikasi web, mobile, maupun eksplorasi IoT.
                Mari saling terhubung!
            </p>

            <div class="flex flex-wrap items-center justify-center gap-3">
                @if ($siteProfile->email)
                    <a
                        href="mailto:{{ $siteProfile->email }}"
                        class="flex items-center gap-2 rounded-full bg-orange-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-orange-600/30 transition-all duration-200 hover:-translate-y-0.5 hover:bg-orange-500"
                    >
                        <x-icon name="mail" class="size-4" />
                        <span>Hubungi Saya</span>
                    </a>
                @endif
                @if ($siteProfile->github_url)
                    <a
                        href="{{ $siteProfile->github_url }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center gap-2 rounded-full border border-surface-highest bg-surface-low px-6 py-3 text-sm font-semibold text-white transition-all duration-200 hover:-translate-y-0.5 hover:bg-surface-high"
                    >
                        <x-icon name="github" class="size-4" />
                        <span>GitHub Profile</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
