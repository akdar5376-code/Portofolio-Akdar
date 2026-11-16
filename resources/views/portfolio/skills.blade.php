@extends('layouts.app')

@section('title', 'Keahlian | '.$profile->full_name)
@section('description', 'Hard skill dan soft skill '.$profile->full_name.' beserta tingkat penguasaan.')

@section('content')
    <x-page-header
        badge="Kompetensi"
        title="Keahlian"
        description="Kemampuan teknis dan non-teknis yang saya pelajari serta terapkan dalam proyek dan kegiatan sehari-hari."
    />

    <section class="mx-auto max-w-6xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="grid gap-6 lg:grid-cols-2">
            <div class="rounded-2xl border border-surface-highest bg-surface-low p-6 shadow-card-dark sm:p-8">
                <div class="mb-6 flex items-center gap-3">
                    <span class="flex size-11 items-center justify-center rounded-xl border border-blue-500/30 bg-blue-500/10 text-blue-600 dark:text-blue-300">
                        <x-icon name="terminal" class="size-5" />
                    </span>
                    <div>
                        <h2 class="text-lg font-bold text-heading">Hard Skill</h2>
                        <p class="font-mono text-[10px] uppercase tracking-widest text-outline">Kemampuan Teknis</p>
                    </div>
                    <span class="ml-auto rounded-full border border-surface-highest bg-surface-container px-2.5 py-1 font-mono text-[11px] text-on-surface-variant">{{ $hardSkills->count() }} item</span>
                </div>

                <div class="space-y-5">
                    @forelse ($hardSkills as $skill)
                        <x-skill-bar :skill="$skill" />
                    @empty
                        <p class="text-sm text-on-surface-variant">Belum ada data hard skill.</p>
                    @endforelse
                </div>
            </div>

            <div class="rounded-2xl border border-surface-highest bg-surface-low p-6 shadow-card-dark sm:p-8">
                <div class="mb-6 flex items-center gap-3">
                    <span class="flex size-11 items-center justify-center rounded-xl border border-emerald-500/30 bg-emerald-500/10 text-emerald-600 dark:text-emerald-300">
                        <x-icon name="users" class="size-5" />
                    </span>
                    <div>
                        <h2 class="text-lg font-bold text-heading">Soft Skill</h2>
                        <p class="font-mono text-[10px] uppercase tracking-widest text-outline">Kemampuan Non-teknis</p>
                    </div>
                    <span class="ml-auto rounded-full border border-surface-highest bg-surface-container px-2.5 py-1 font-mono text-[11px] text-on-surface-variant">{{ $softSkills->count() }} item</span>
                </div>

                <div class="space-y-5">
                    @forelse ($softSkills as $skill)
                        <x-skill-bar :skill="$skill" />
                    @empty
                        <p class="text-sm text-on-surface-variant">Belum ada data soft skill.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="mt-6 rounded-2xl border border-surface-highest bg-gradient-to-r from-blue-600/10 via-transparent to-cyan-500/10 p-6 text-center sm:p-8">
            <h2 class="text-lg font-bold text-heading">Ingin melihat keahlian ini diterapkan secara nyata?</h2>
            <p class="mx-auto mt-2 max-w-xl text-sm text-on-surface-variant">Lihat bagaimana kemampuan teknis dan non-teknis saya digunakan dalam proyek-proyek yang sudah saya kerjakan.</p>
            <a href="{{ route('projects.index') }}" class="mt-5 inline-flex items-center gap-2 rounded-full bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-600/25 transition-colors hover:bg-blue-500">
                Lihat Galeri Proyek
                <x-icon name="arrow-right" class="size-4" />
            </a>
        </div>
    </section>
@endsection
