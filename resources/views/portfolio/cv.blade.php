@extends('layouts.app')

@section('title', 'CV Digital | '.$profile->full_name)
@section('description', 'CV digital '.$profile->full_name.' berisi ringkasan profil, pendidikan, pengalaman, keahlian, dan sertifikat.')

@section('content')
    @php
        $initials = \Illuminate\Support\Str::of($profile->full_name)
            ->explode(' ')
            ->map(fn ($part) => \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($part, 0, 1)))
            ->take(2)
            ->implode('');
    @endphp

    <x-page-header
        badge="Resume"
        title="CV Digital"
        description="Ringkasan profil, pendidikan, pengalaman, keahlian, dan sertifikat dalam satu halaman."
    >
        <div class="mt-6 flex flex-wrap items-center justify-center gap-2 no-print">
            <button type="button" onclick="window.print()" class="flex items-center gap-2 rounded-full bg-orange-600 px-5 py-2.5 text-xs font-semibold text-white transition-colors hover:bg-orange-500">
                <x-icon name="printer" class="size-4" />
                Cetak / Simpan PDF
            </button>
            @if ($profile->cv_url)
                <a href="{{ $profile->cv_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 rounded-full border border-surface-highest bg-surface-low px-5 py-2.5 text-xs font-semibold text-on-surface transition-colors hover:border-orange-500/40">
                    <x-icon name="download" class="size-4" />
                    Unduh File CV
                </a>
            @endif
            <a href="{{ route('contact') }}" class="flex items-center gap-2 rounded-full border border-surface-highest bg-surface-low px-5 py-2.5 text-xs font-semibold text-on-surface transition-colors hover:border-amber-500/40">
                <x-icon name="mail" class="size-4" />
                Hubungi Saya
            </a>
        </div>
    </x-page-header>

    <section class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="cv-document overflow-hidden border border-stone-200 bg-white text-stone-900 shadow-sm dark:border-stone-700 dark:bg-white dark:text-stone-900">
            <header class="border-b border-stone-300 bg-white p-6 sm:p-8">
                <div class="flex flex-row-reverse items-start justify-between gap-5">
                    <div class="flex h-24 w-20 shrink-0 items-center justify-center overflow-hidden bg-stone-100">
                        @if ($profile->avatar_url)
                            <img src="{{ $profile->avatar_url }}" alt="{{ $profile->full_name }}" class="h-full w-full object-contain">
                        @else
                            <span class="font-mono text-2xl font-extrabold">{{ $initials }}</span>
                        @endif
                    </div>
                    <div class="min-w-0 flex-1">
                        <h1 class="text-2xl font-extrabold uppercase tracking-tight sm:text-3xl">{{ $profile->full_name }}</h1>
                        @php($headline = collect([$profile->role, $profile->competency])->filter()->implode(' | '))
                        @if ($headline !== '')
                            <p class="mt-1 text-sm font-medium text-on-surface-variant">{{ $headline }}</p>
                        @endif
                        @if (count($profile->interest_list))
                            <p class="mt-1 text-xs text-on-surface-variant">{{ implode(' | ', $profile->interest_list) }}</p>
                        @endif
                        <div class="mt-3 flex flex-wrap gap-x-4 gap-y-1.5 text-xs text-on-surface-variant">
                            @if ($profile->email)
                                <a href="mailto:{{ $profile->email }}" class="flex items-center gap-1.5 hover:text-orange-800 dark:hover:text-orange-300">
                                    <x-icon name="mail" class="size-3.5" />
                                    {{ $profile->email }}
                                </a>
                            @endif
                            @if ($profile->github_url)
                                <a href="{{ $profile->github_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1.5 hover:text-orange-800 dark:hover:text-orange-300">
                                    <x-icon name="github" class="size-3.5" />
                                    GitHub
                                </a>
                            @endif
                            @if ($profile->instagram_url)
                                <a href="{{ $profile->instagram_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1.5 hover:text-orange-800 dark:hover:text-orange-300">
                                    <x-icon name="instagram" class="size-3.5" />
                                    Instagram
                                </a>
                            @endif
                            @if ($profile->linkedin_url)
                                <a href="{{ $profile->linkedin_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1.5 hover:text-orange-800 dark:hover:text-orange-300">
                                    <x-icon name="linkedin" class="size-3.5" />
                                    LinkedIn
                                </a>
                            @endif
                            @if ($profile->class_name)
                                <span class="flex items-center gap-1.5"><x-icon name="graduation-cap" class="size-3.5" />{{ $profile->class_name }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </header>

            <div class="grid gap-7 p-6 sm:p-8">
                <div class="space-y-8">
                    <section>
                        <h2 class="mb-3 flex items-center gap-2 border-b border-surface-highest pb-2 text-sm font-extrabold uppercase tracking-wider text-heading">
                            <x-icon name="user" class="size-4 text-orange-500" />
                            Profil Singkat
                        </h2>
                        <p class="text-sm leading-relaxed text-on-surface-variant">{{ $profile->bio ?: 'Belum ada ringkasan profil.' }}</p>
                        @if ($profile->career_goal)
                            <p class="mt-3 text-sm leading-relaxed text-on-surface-variant"><span class="font-semibold text-heading">Tujuan karir:</span> {{ $profile->career_goal }}</p>
                        @endif
                    </section>

                    <section>
                        <h2 class="mb-3 flex items-center gap-2 border-b border-surface-highest pb-2 text-sm font-extrabold uppercase tracking-wider text-heading">
                            <x-icon name="graduation-cap" class="size-4 text-orange-500" />
                            Pendidikan
                        </h2>
                        <div class="space-y-3">
                            @forelse ($educations as $education)
                                <div class="print-card">
                                    <div class="flex flex-wrap items-baseline justify-between gap-1">
                                        <h3 class="text-sm font-bold text-heading">{{ $education->institution }}</h3>
                                        <span class="font-mono text-[11px] text-outline">{{ $education->period }}</span>
                                    </div>
                                    <p class="text-xs font-medium text-orange-600 dark:text-orange-300">{{ $education->level }}</p>
                                    @if ($education->description)
                                        <p class="mt-1 text-xs leading-relaxed text-on-surface-variant">{{ $education->description }}</p>
                                    @endif
                                </div>
                            @empty
                                <p class="text-xs text-on-surface-variant">Belum ada riwayat pendidikan.</p>
                            @endforelse
                        </div>
                    </section>

                    <section>
                        <h2 class="mb-3 flex items-center gap-2 border-b border-surface-highest pb-2 text-sm font-extrabold uppercase tracking-wider text-heading">
                            <x-icon name="briefcase" class="size-4 text-amber-500" />
                            Pengalaman
                        </h2>
                        <div class="space-y-3">
                            @forelse ($experiences as $experience)
                                <div class="print-card">
                                    <div class="flex flex-wrap items-baseline justify-between gap-1">
                                        <h3 class="text-sm font-bold text-heading">{{ $experience->title }}</h3>
                                        <span class="font-mono text-[11px] text-outline">{{ $experience->period }}</span>
                                    </div>
                                    <p class="text-xs font-medium text-orange-600 dark:text-orange-300">{{ $experience->organization }} — {{ $experience->type->shortLabel() }}</p>
                                    @if ($experience->description)
                                        <p class="mt-1 text-xs leading-relaxed text-on-surface-variant">{{ $experience->description }}</p>
                                    @endif
                                </div>
                            @empty
                                <p class="text-xs text-on-surface-variant">Belum ada pengalaman.</p>
                            @endforelse
                        </div>
                    </section>
                </div>

                <aside class="grid gap-6 sm:grid-cols-2">
                    <section>
                        <h2 class="mb-3 flex items-center gap-2 border-b border-surface-highest pb-2 text-sm font-extrabold uppercase tracking-wider text-heading">
                            <x-icon name="zap" class="size-4 text-orange-500" />
                            Hard Skill
                        </h2>
                        <div class="space-y-3">
                            @foreach ($hardSkills as $skill)
                                <div class="print-card">
                                    <div class="mb-1 flex items-center justify-between text-xs">
                                        <span class="font-semibold text-heading">{{ $skill->name }}</span>
                                        <span class="font-mono text-[10px] text-outline">{{ $skill->percentage }}%</span>
                                    </div>
                                    <div class="h-1.5 overflow-hidden rounded-full bg-surface-high">
                                        <div class="skill-bar-fill h-full rounded-full bg-gradient-to-r from-orange-600 to-stone-400" style="--bar-target: {{ (int) $skill->percentage }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <section>
                        <h2 class="mb-3 flex items-center gap-2 border-b border-surface-highest pb-2 text-sm font-extrabold uppercase tracking-wider text-heading">
                            <x-icon name="users" class="size-4 text-amber-500" />
                            Soft Skill
                        </h2>
                        <div class="space-y-3">
                            @foreach ($softSkills as $skill)
                                <div class="print-card">
                                    <div class="mb-1 flex items-center justify-between text-xs">
                                        <span class="font-semibold text-heading">{{ $skill->name }}</span>
                                        <span class="font-mono text-[10px] text-outline">{{ $skill->percentage }}%</span>
                                    </div>
                                    <div class="h-1.5 overflow-hidden rounded-full bg-surface-high">
                                        <div class="skill-bar-fill h-full rounded-full bg-gradient-to-r from-amber-600 to-teal-400" style="--bar-target: {{ (int) $skill->percentage }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <section class="sm:col-span-2">
                        <h2 class="mb-3 flex items-center gap-2 border-b border-surface-highest pb-2 text-sm font-extrabold uppercase tracking-wider text-heading">
                            <x-icon name="award" class="size-4 text-amber-500" />
                            Sertifikat &amp; Prestasi
                        </h2>
                        <ul class="space-y-2.5">
                            @forelse ($certificates as $certificate)
                                <li class="print-card">
                                    <p class="text-xs font-semibold leading-snug text-heading">{{ $certificate->title }}</p>
                                    <p class="font-mono text-[10px] text-outline">{{ $certificate->issuer }}{{ $certificate->year ? ' • '.$certificate->year : '' }}</p>
                                </li>
                            @empty
                                <li class="text-xs text-on-surface-variant">Belum ada sertifikat.</li>
                            @endforelse
                        </ul>
                    </section>
                </aside>
            </div>
        </div>
    </section>
@endsection
