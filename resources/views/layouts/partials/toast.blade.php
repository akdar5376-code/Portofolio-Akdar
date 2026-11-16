@if (session('status'))
    <div
        class="fixed bottom-24 right-5 z-[60] flex items-center gap-3 rounded-xl border border-emerald-500/40 border-l-4 border-l-emerald-500 bg-surface-low px-4 py-3 text-on-surface opacity-100 shadow-2xl transition-all duration-300 sm:right-6"
        data-toast
        role="status"
        aria-live="polite"
    >
        <x-icon name="check-circle" class="size-[22px] text-emerald-500" />
        <div class="flex flex-col">
            <span class="text-xs font-bold text-heading">{{ session('status_title', 'Berhasil') }}</span>
            <span class="font-mono text-[11px] text-on-surface-variant">{{ session('status') }}</span>
        </div>
    </div>
@endif
