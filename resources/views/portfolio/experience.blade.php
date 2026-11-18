@extends('layouts.app')

@section('title', 'Pengalaman | '.$profile->full_name)
@section('description', 'Pengalaman PLK, organisasi, kepanitiaan, dan lomba '.$profile->full_name.'.')

@section('content')
    @php
        $grouped = $experiences->groupBy(fn ($experience) => $experience->type->value);
        $types = \App\Enums\ExperienceType::cases();
    @endphp

    <x-page-header
        badge="Perjalanan"
        title="Pengalaman"
        description="Praktik kerja lapangan, organisasi, kepanitiaan, dan kompetisi yang membentuk cara saya belajar dan bekerja."
    />

    <section class="mx-auto max-w-5xl px-4 py-16 sm:px-6 lg:px-8">
        @if ($experiences->isEmpty())
            <div class="rounded-3xl border border-surface-highest bg-surface-low py-20 text-center">
                <div class="mx-auto mb-4 flex size-16 items-center justify-center rounded-lg border border-surface-highest bg-surface-high text-orange-500">
                    <x-icon name="briefcase" class="size-8" />
                </div>
                <p class="text-base font-semibold text-heading">Belum ada pengalaman yang ditampilkan.</p>
                <p class="mt-1 text-xs text-on-surface-variant">Pengalaman akan muncul setelah ditambahkan dari panel admin.</p>
            </div>
        @else
            <div class="space-y-12">
                @foreach ($types as $type)
                    @php($items = $grouped->get($type->value, collect()))
                    @if ($items->isNotEmpty())
                        <div>
                            <div class="mb-5 flex items-center gap-3">
                                <span class="flex size-10 items-center justify-center rounded-xl border {{ $type->accentClasses()['icon'] }}">
                                    <x-icon :name="$type->icon()" class="size-5" />
                                </span>
                                <div>
                                    <h2 class="text-lg font-extrabold tracking-tight text-heading">{{ $type->label() }}</h2>
                                    <p class="font-mono text-[10px] uppercase tracking-widest text-outline">{{ $items->count() }} pengalaman</p>
                                </div>
                            </div>
                            <div class="space-y-4">
                                @foreach ($items as $experience)
                                    <x-experience-card :experience="$experience" />
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

        <div class="mt-12 grid gap-4 sm:grid-cols-2">
            <a href="{{ route('about') }}" class="flex items-center gap-3 rounded-lg border border-surface-highest bg-surface-low p-5 transition-colors hover:border-orange-500/30">
                <span class="flex size-10 items-center justify-center rounded-xl bg-orange-600/10 text-orange-600 dark:text-orange-300">
                    <x-icon name="user" class="size-5" />
                </span>
                <div>
                    <p class="text-sm font-bold text-heading">Tentang Saya</p>
                    <p class="text-xs text-on-surface-variant">Biodata dan perjalanan pendidikan.</p>
                </div>
            </a>
            <a href="{{ route('certificates') }}" class="flex items-center gap-3 rounded-lg border border-surface-highest bg-surface-low p-5 transition-colors hover:border-orange-500/30">
                <span class="flex size-10 items-center justify-center rounded-xl bg-amber-500/10 text-amber-600 dark:text-amber-300">
                    <x-icon name="award" class="size-5" />
                </span>
                <div>
                    <p class="text-sm font-bold text-heading">Sertifikat &amp; Prestasi</p>
                    <p class="text-xs text-on-surface-variant">Dokumentasi penghargaan yang diraih.</p>
                </div>
            </a>
        </div>
    </section>
@endsection
