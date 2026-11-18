@extends('layouts.app')

@section('title', 'Tentang Saya | '.$profile->full_name)
@section('description', 'Biodata, riwayat pendidikan, minat teknologi, pengalaman organisasi dan PLK, serta tujuan karir '.$profile->full_name.'.')

@section('content')
    <x-page-header
        badge="Profil"
        title="Tentang Saya"
        description="Perjalanan belajar, minat di bidang teknologi, dan pengalaman yang membentuk cara saya bekerja."
    />

    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="grid gap-6 lg:grid-cols-[1.35fr_0.65fr]">
            <div class="rounded-lg border border-surface-highest bg-surface-low p-6 shadow-sm sm:p-8">
                <div class="mb-4 flex items-center gap-2">
                    <span class="flex size-9 items-center justify-center rounded-xl border border-orange-500/30 bg-orange-500/10 text-orange-600 dark:text-orange-300">
                        <x-icon name="user" class="size-4" />
                    </span>
                    <h2 class="text-lg font-bold text-heading">Biodata Singkat</h2>
                </div>
                <p class="text-sm leading-relaxed text-on-surface-variant sm:text-base">
                    {{ $profile->bio ?: 'Belum ada biodata.' }}
                </p>

                <div class="mt-6 grid gap-3 sm:grid-cols-2">
                    @foreach ([
                        ['label' => 'Nama Lengkap', 'value' => $profile->full_name, 'icon' => 'user'],
                        ['label' => 'Kelas', 'value' => $profile->class_name, 'icon' => 'graduation-cap'],
                        ['label' => 'Kompetensi Keahlian', 'value' => $profile->competency, 'icon' => 'code'],
                    ] as $item)
                        @if ($item['value'])
                            <div class="flex items-start gap-3 rounded-xl border border-surface-highest bg-surface-container/50 p-3.5">
                                <x-icon :name="$item['icon']" class="mt-0.5 size-4 shrink-0 text-orange-500" />
                                <div>
                                    <p class="font-mono text-[10px] uppercase tracking-widest text-outline">{{ $item['label'] }}</p>
                                    <p class="mt-0.5 text-sm font-semibold text-heading">{{ $item['value'] }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                @if (count($profile->interest_list))
                    <div class="mt-6">
                        <h3 class="mb-3 flex items-center gap-2 text-sm font-bold text-heading">
                            <x-icon name="sparkles" class="size-4 text-stone-500" />
                            Minat &amp; Bidang Teknologi
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($profile->interest_list as $interest)
                                <span class="rounded-full border border-surface-highest bg-surface-container px-3 py-1.5 text-xs font-medium text-on-surface-variant">{{ $interest }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="space-y-6">
                <div class="rounded-lg border border-surface-highest bg-surface-low p-6 shadow-sm">
                    <div class="mb-3 flex items-center gap-2">
                        <span class="flex size-9 items-center justify-center rounded-xl border border-amber-500/30 bg-amber-500/10 text-amber-600 dark:text-amber-300">
                            <x-icon name="target" class="size-4" />
                        </span>
                        <h2 class="text-base font-bold text-heading">Cita-cita &amp; Tujuan Karir</h2>
                    </div>
                    <p class="text-sm leading-relaxed text-on-surface-variant">
                        {{ $profile->career_goal ?: 'Belum diisi.' }}
                    </p>
                </div>

                <div class="rounded-lg border border-surface-highest bg-surface-low p-6 shadow-sm">
                    <h2 class="mb-3 text-base font-bold text-heading">Kontak Cepat</h2>
                    <div class="space-y-2.5">
                        @if ($profile->email)
                            <a href="mailto:{{ $profile->email }}" class="flex items-center gap-2 text-sm text-on-surface-variant hover:text-orange-600 dark:hover:text-orange-300">
                                <x-icon name="mail" class="size-4 text-orange-500" />
                                {{ $profile->email }}
                            </a>
                        @endif
                        @if ($profile->github_url)
                            <a href="{{ $profile->github_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-sm text-on-surface-variant hover:text-orange-600 dark:hover:text-orange-300">
                                <x-icon name="github" class="size-4 text-orange-500" />
                                GitHub
                            </a>
                        @endif
                        @if ($profile->instagram_url)
                            <a href="{{ $profile->instagram_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-sm text-on-surface-variant hover:text-orange-600 dark:hover:text-orange-300">
                                <x-icon name="instagram" class="size-4 text-orange-500" />
                                Instagram
                            </a>
                        @endif
                        @if ($profile->linkedin_url)
                            <a href="{{ $profile->linkedin_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-sm text-on-surface-variant hover:text-orange-600 dark:hover:text-orange-300">
                                <x-icon name="linkedin" class="size-4 text-orange-500" />
                                LinkedIn
                            </a>
                        @endif
                        <a href="{{ route('contact') }}" class="mt-2 inline-flex items-center gap-1.5 rounded-full bg-orange-600 px-4 py-2 text-xs font-semibold text-white transition-colors hover:bg-orange-500">
                            <x-icon name="message-circle" class="size-3.5" />
                            Kirim Pesan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 pb-16 sm:px-6 lg:px-8">
        <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-lg border border-surface-highest bg-surface-low p-6 shadow-sm sm:p-8">
        <div class="mb-6 flex items-center gap-2">
            <span class="flex size-9 items-center justify-center rounded-xl border border-orange-500/30 bg-orange-500/10 text-orange-600 dark:text-orange-300">
                <x-icon name="graduation-cap" class="size-4" />
            </span>
            <div>
                <h2 class="text-xl font-extrabold tracking-tight text-heading">Riwayat Pendidikan</h2>
                <p class="text-xs text-on-surface-variant">Jejak pendidikan formal yang saya tempuh.</p>
            </div>
        </div>

        @if ($educations->isEmpty())
            <p class="rounded-xl border border-surface-highest bg-surface-low p-6 text-sm text-on-surface-variant">Belum ada riwayat pendidikan.</p>
        @else
            <div class="relative space-y-4 border-l border-surface-highest pl-6 sm:pl-8">
                @foreach ($educations as $education)
                    <div class="relative rounded-lg border border-surface-highest bg-surface-low p-5 shadow-sm">
                        <span class="absolute -left-[31px] top-6 size-3 rounded-full border-2 border-background bg-orange-500 sm:-left-[39px]"></span>
                        <div class="flex flex-wrap items-center gap-2">
                            @if ($education->level)
                                <span class="rounded-full border border-orange-500/30 bg-orange-500/10 px-2.5 py-0.5 font-mono text-[10px] font-bold uppercase tracking-wider text-orange-600 dark:text-orange-300">{{ $education->level }}</span>
                            @endif
                            @if ($education->period)
                                <span class="flex items-center gap-1 font-mono text-[11px] text-outline">
                                    <x-icon name="calendar" class="size-3" />
                                    {{ $education->period }}
                                </span>
                            @endif
                        </div>
                        <h3 class="mt-2 text-base font-bold text-heading">{{ $education->institution }}</h3>
                        @if ($education->description)
                            <p class="mt-1.5 text-sm leading-relaxed text-on-surface-variant">{{ $education->description }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
        </div>

        <div class="rounded-lg border border-surface-highest bg-surface-low p-6 shadow-sm sm:p-8">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-2">
                <span class="flex size-9 items-center justify-center rounded-xl border border-amber-500/30 bg-amber-500/10 text-amber-600 dark:text-amber-300">
                    <x-icon name="briefcase" class="size-4" />
                </span>
                <div>
                    <h2 class="text-xl font-extrabold tracking-tight text-heading">Pengalaman Organisasi, PLK &amp; Lomba</h2>
                    <p class="text-xs text-on-surface-variant">Pengalaman yang membentuk kemampuan teknis dan non-teknis saya.</p>
                </div>
            </div>
        </div>

        @if ($experiences->isEmpty())
            <p class="rounded-xl border border-surface-highest bg-surface-low p-6 text-sm text-on-surface-variant">Belum ada pengalaman.</p>
        @else
            <div class="grid gap-4">
                @foreach ($experiences as $experience)
                    <x-experience-card :experience="$experience" />
                @endforeach
            </div>
        @endif
        </div>
        </div>
    </section>
@endsection
