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
            <div class="border-y border-surface-highest bg-surface-low p-6 sm:p-8">
                <div class="mb-6 flex items-center gap-3">
                    <span class="flex size-11 items-center justify-center rounded-xl border border-orange-500/30 bg-orange-500/10 text-orange-600 dark:text-orange-300">
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

            <div class="border-y border-surface-highest bg-surface-low p-6 sm:p-8">
                <div class="mb-6 flex items-center gap-3">
                    <span class="flex size-11 items-center justify-center rounded-xl border border-amber-500/30 bg-amber-500/10 text-amber-600 dark:text-amber-300">
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
    </section>
@endsection
