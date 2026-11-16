<div
    class="fixed inset-0 z-[70] flex items-center justify-center bg-slate-950/70 p-4 backdrop-blur-sm"
    data-project-preview-modal
    aria-hidden="true"
    role="dialog"
    aria-modal="true"
    aria-labelledby="preview-title"
>
    <div class="relative max-h-[90vh] w-full max-w-3xl overflow-y-auto rounded-2xl border border-surface-highest bg-surface-low shadow-2xl">
        <button
            type="button"
            class="absolute right-3 top-3 z-10 flex size-9 cursor-pointer items-center justify-center rounded-full border border-surface-highest bg-surface-lowest/90 text-on-surface shadow-md backdrop-blur transition-colors hover:bg-red-500 hover:text-white"
            data-preview-close
            aria-label="Tutup preview proyek"
        >
            <x-icon name="x" class="size-4" />
        </button>

        <div class="relative aspect-video w-full overflow-hidden bg-surface-container">
                <img src="" alt="" data-preview-image class="h-full w-full object-contain">
            <div class="absolute inset-0 bg-gradient-to-t from-surface-low via-transparent to-transparent"></div>
        </div>

        <div class="p-6 sm:p-8">
            <span class="mb-2 inline-flex items-center gap-1.5 rounded-full border border-blue-500/30 bg-blue-500/10 px-3 py-1 font-mono text-[10px] font-bold uppercase tracking-wider text-blue-600 dark:text-blue-300" data-preview-category></span>
            <h2 id="preview-title" class="text-2xl font-extrabold tracking-tight text-heading" data-preview-title></h2>
            <p class="mt-2 text-sm leading-relaxed text-on-surface-variant" data-preview-description></p>

            <div class="mt-5 flex flex-wrap gap-1.5" data-preview-tech></div>

            <div class="mt-5 grid gap-4 sm:grid-cols-2">
                <div class="rounded-xl border border-surface-highest bg-surface-container/60 p-4">
                    <div class="mb-1 flex items-center gap-1.5 font-mono text-[10px] font-bold uppercase tracking-wider text-rose-500 dark:text-rose-300">
                        <x-icon name="target" class="size-3.5" />
                        Permasalahan
                    </div>
                    <p class="text-xs leading-relaxed text-on-surface-variant" data-preview-problem></p>
                </div>
                <div class="rounded-xl border border-surface-highest bg-surface-container/60 p-4">
                    <div class="mb-1 flex items-center gap-1.5 font-mono text-[10px] font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-300">
                        <x-icon name="compass" class="size-3.5" />
                        Tujuan
                    </div>
                    <p class="text-xs leading-relaxed text-on-surface-variant" data-preview-goal></p>
                </div>
            </div>

            <p class="mt-4 flex items-center gap-1.5 text-xs text-on-surface-variant">
                <x-icon name="user" class="size-3.5 text-blue-500" />
                Peran: <span class="font-semibold text-heading" data-preview-role></span>
            </p>

            <div class="mt-6 flex flex-wrap items-center gap-2">
                <a href="#" data-preview-detail class="flex items-center gap-1.5 rounded-full bg-blue-600 px-5 py-2.5 text-xs font-semibold text-white shadow-lg shadow-blue-600/25 transition-colors hover:bg-blue-500">
                    <x-icon name="file-text" class="size-3.5" />
                    Detail Proyek
                </a>
                <a href="#" target="_blank" rel="noopener noreferrer" data-preview-demo class="hidden items-center gap-1.5 rounded-full border border-surface-highest bg-surface-container px-5 py-2.5 text-xs font-semibold text-on-surface transition-colors hover:border-blue-500/40">
                    <x-icon name="external-link" class="size-3.5" />
                    Live Demo
                </a>
                <a href="#" target="_blank" rel="noopener noreferrer" data-preview-github class="hidden items-center gap-1.5 rounded-full border border-surface-highest bg-surface-container px-5 py-2.5 text-xs font-semibold text-on-surface transition-colors hover:border-blue-500/40">
                    <x-icon name="github" class="size-3.5" />
                    Source Code
                </a>
            </div>
        </div>
    </div>
</div>
