@extends('layouts.admin-app')

@php
    $sectionLabels = [
        'skills' => 'Keahlian',
        'experiences' => 'Pengalaman',
        'educations' => 'Pendidikan',
    ];
@endphp

@section('title', 'Kelola '.$sectionLabels[$section])
@section('heading', 'Kelola '.$sectionLabels[$section])

@section('content')
    @php
        $skillTypeOptions = collect(\App\Enums\SkillType::cases())->mapWithKeys(fn ($type) => [$type->value => $type->label()]);
        $experienceTypeOptions = collect(\App\Enums\ExperienceType::cases())->mapWithKeys(fn ($type) => [$type->value => $type->label()]);
    @endphp

    <div class="mb-6">
        <h2 class="text-2xl font-extrabold tracking-tight text-heading">Kelola {{ $sectionLabels[$section] }}</h2>
        <p class="mt-1 text-sm text-on-surface-variant">Tambah, ubah, dan hapus data {{ strtolower($sectionLabels[$section]) }} secara terpisah.</p>
    </div>

    @if ($section === 'skills')
    <section id="skills" class="scroll-mt-24">
        <div class="grid min-w-0 items-start gap-4 lg:grid-cols-[minmax(0,20rem)_minmax(0,1fr)] lg:gap-5">
            <div class="rounded-lg border border-surface-highest bg-surface-low p-4 shadow-sm sm:p-5">
                <div class="mb-4 border-b border-surface-highest pb-3">
                    <h2 class="flex items-center gap-2 text-base font-bold text-heading">
                        <x-icon :name="$editingSkill ? 'edit' : 'plus-circle'" class="size-4 text-orange-500" />
                        {{ $editingSkill ? 'Edit Keahlian' : 'Tambah Keahlian' }}
                    </h2>
                </div>

                <form method="POST" action="{{ $editingSkill ? route('admin.skills.update', $editingSkill) : route('admin.skills.store') }}" class="space-y-4">
                    @csrf
                    @if ($editingSkill)
                        @method('PUT')
                    @endif

                    <x-admin.input label="Nama Keahlian" name="name" :value="$editingSkill?->name" required maxlength="100" placeholder="Contoh: Laravel" />
                    <div class="grid gap-4 sm:grid-cols-2">
                        <x-admin.select label="Jenis" name="type" :options="$skillTypeOptions" :value="$editingSkill?->type?->value ?? \App\Enums\SkillType::Hard->value" required />
                        <x-admin.input label="Persentase" name="percentage" type="number" :value="$editingSkill?->percentage ?? 80" required min="0" max="100" />
                    </div>
                    <x-admin.input label="Nama Ikon" name="icon" :value="$editingSkill?->icon ?? 'code'" maxlength="50" hint="" placeholder="" />

                    <div class="flex items-center gap-2">
                        <button type="submit" class="flex flex-1 cursor-pointer items-center justify-center gap-2 rounded-xl bg-orange-600 px-4 py-2.5 text-xs font-semibold text-white transition-colors hover:bg-orange-500">
                            <x-icon :name="$editingSkill ? 'check-circle' : 'plus'" class="size-4" />
                            {{ $editingSkill ? 'Simpan' : 'Tambah' }}
                        </button>
                        @if ($editingSkill)
                            <a href="{{ route('admin.content.skills') }}" class="rounded-xl border border-surface-highest bg-background px-3 py-2.5 text-xs font-semibold text-on-surface">Batal</a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="min-w-0 rounded-lg border border-surface-highest bg-surface-low p-4 shadow-sm sm:p-5">
                <div class="mb-4 flex flex-wrap items-center justify-between gap-2">
                    <h2 class="text-base font-bold text-heading">Daftar Keahlian</h2>
                    <span class="rounded-full border border-surface-highest bg-surface-container px-2.5 py-1 font-mono text-[10px] text-on-surface-variant">{{ $skills->count() }} item</span>
                </div>
                <div class="space-y-2.5">
                    @forelse ($skills as $skill)
                        <div class="flex min-w-0 items-center gap-2 rounded-xl border border-surface-highest bg-surface-container/40 p-3 sm:gap-3">
                            <span class="flex size-9 shrink-0 items-center justify-center rounded-lg {{ $skill->type->barClasses()['badge'] }}">
                                <x-skill-icons :skill="$skill" />
                            </span>
                            <div class="min-w-0 flex-grow">
                                <div class="flex items-center justify-between gap-2">
                                    <p class="truncate text-sm font-semibold text-heading">{{ $skill->name }}</p>
                                    <span class="font-mono text-[10px] text-outline">{{ $skill->percentage }}%</span>
                                </div>
                                <div class="mt-1.5 h-1.5 overflow-hidden rounded-full bg-surface-high">
                                    <div class="h-full rounded-full {{ $skill->type->barClasses()['bar'] }}" style="width: {{ $skill->percentage }}%"></div>
                                </div>
                            </div>
                            <div class="flex shrink-0 items-center gap-1">
                                <a href="{{ route('admin.content.skills', ['edit_skill' => $skill->id]) }}" class="flex size-9 items-center justify-center rounded-lg text-on-surface-variant transition-colors hover:bg-surface-high hover:text-heading">
                                    <x-icon name="edit" class="size-3.5" />
                                </a>
                                <form method="POST" action="{{ route('admin.skills.destroy', $skill) }}" data-confirm="Hapus keahlian ini?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex size-9 cursor-pointer items-center justify-center rounded-lg text-on-surface-variant transition-colors hover:bg-red-500/10 hover:text-red-500">
                                        <x-icon name="trash" class="size-3.5" />
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="py-8 text-center text-sm text-on-surface-variant">Belum ada keahlian.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    @elseif ($section === 'experiences')
    <section id="experiences" class="mt-8 scroll-mt-24">
        <div class="grid min-w-0 items-start gap-4 lg:grid-cols-[minmax(0,20rem)_minmax(0,1fr)] lg:gap-5">
            <div class="rounded-lg border border-surface-highest bg-surface-low p-4 shadow-sm sm:p-5">
                <div class="mb-4 border-b border-surface-highest pb-3">
                    <h2 class="flex items-center gap-2 text-base font-bold text-heading">
                        <x-icon :name="$editingExperience ? 'edit' : 'plus-circle'" class="size-4 text-amber-500" />
                        {{ $editingExperience ? 'Edit Pengalaman' : 'Tambah Pengalaman' }}
                    </h2>
                </div>

                <form method="POST" action="{{ $editingExperience ? route('admin.experiences.update', $editingExperience) : route('admin.experiences.store') }}" class="space-y-4">
                    @csrf
                    @if ($editingExperience)
                        @method('PUT')
                    @endif

                    <x-admin.input label="Judul / Posisi" name="title" :value="$editingExperience?->title" required maxlength="150" placeholder="Contoh: Praktik Kerja Lapangan" />
                    <x-admin.input label="Organisasi / Tempat" name="organization" :value="$editingExperience?->organization" maxlength="150" placeholder="Nama perusahaan atau organisasi" />
                    <div class="grid gap-4 sm:grid-cols-2">
                        <x-admin.select label="Jenis" name="type" :options="$experienceTypeOptions" :value="$editingExperience?->type?->value ?? \App\Enums\ExperienceType::Organization->value" required />
                        <x-admin.input label="Periode" name="period" :value="$editingExperience?->period" maxlength="100" placeholder="2025 - 2026" />
                    </div>
                    <x-admin.textarea label="Deskripsi" name="description" :value="$editingExperience?->description" :rows="4" maxlength="2000" placeholder="Uraikan kegiatan dan pencapaian." />

                    <div class="flex items-center gap-2">
                        <button type="submit" class="flex flex-1 cursor-pointer items-center justify-center gap-2 rounded-xl bg-amber-600 px-4 py-2.5 text-xs font-semibold text-white transition-colors hover:bg-amber-500">
                            <x-icon :name="$editingExperience ? 'check-circle' : 'plus'" class="size-4" />
                            {{ $editingExperience ? 'Simpan' : 'Tambah' }}
                        </button>
                        @if ($editingExperience)
                            <a href="{{ route('admin.content.experiences') }}" class="rounded-xl border border-surface-highest bg-background px-3 py-2.5 text-xs font-semibold text-on-surface">Batal</a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="min-w-0 rounded-lg border border-surface-highest bg-surface-low p-4 shadow-sm sm:p-5">
                <div class="mb-4 flex flex-wrap items-center justify-between gap-2">
                    <h2 class="text-base font-bold text-heading">Daftar Pengalaman</h2>
                    <span class="rounded-full border border-surface-highest bg-surface-container px-2.5 py-1 font-mono text-[10px] text-on-surface-variant">{{ $experiences->count() }} item</span>
                </div>
                <div class="space-y-2.5">
                    @forelse ($experiences as $experience)
                        <div class="flex items-start gap-3 rounded-xl border border-surface-highest bg-surface-container/40 p-3">
                            <span class="flex size-9 shrink-0 items-center justify-center rounded-lg {{ $experience->type->accentClasses()['icon'] }}">
                                <x-icon :name="$experience->type->icon()" class="size-4" />
                            </span>
                            <div class="min-w-0 flex-grow break-words">
                                <div class="flex flex-wrap items-center gap-1.5">
                                    <p class="text-sm font-semibold text-heading">{{ $experience->title }}</p>
                                    <span class="rounded-full border px-1.5 py-0.5 font-mono text-[9px] font-bold uppercase {{ $experience->type->accentClasses()['badge'] }}">{{ $experience->type->shortLabel() }}</span>
                                </div>
                                <p class="font-mono text-[10px] text-outline">{{ $experience->organization }}{{ $experience->period ? ' • '.$experience->period : '' }}</p>
                            </div>
                            <div class="flex shrink-0 items-center gap-1">
                                <a href="{{ route('admin.content.experiences', ['edit_experience' => $experience->id]) }}" class="flex size-9 items-center justify-center rounded-lg text-on-surface-variant transition-colors hover:bg-surface-high hover:text-heading">
                                    <x-icon name="edit" class="size-3.5" />
                                </a>
                                <form method="POST" action="{{ route('admin.experiences.destroy', $experience) }}" data-confirm="Hapus pengalaman ini?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex size-9 cursor-pointer items-center justify-center rounded-lg text-on-surface-variant transition-colors hover:bg-red-500/10 hover:text-red-500">
                                        <x-icon name="trash" class="size-3.5" />
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="py-8 text-center text-sm text-on-surface-variant">Belum ada pengalaman.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    @elseif ($section === 'educations')
    <section id="educations" class="mt-8 scroll-mt-24">
        <div class="grid min-w-0 items-start gap-4 lg:grid-cols-[minmax(0,20rem)_minmax(0,1fr)] lg:gap-5">
            <div class="rounded-lg border border-surface-highest bg-surface-low p-4 shadow-sm sm:p-5">
                <div class="mb-4 border-b border-surface-highest pb-3">
                    <h2 class="flex items-center gap-2 text-base font-bold text-heading">
                        <x-icon :name="$editingEducation ? 'edit' : 'plus-circle'" class="size-4 text-orange-500" />
                        {{ $editingEducation ? 'Edit Pendidikan' : 'Tambah Pendidikan' }}
                    </h2>
                </div>

                <form method="POST" action="{{ $editingEducation ? route('admin.educations.update', $editingEducation) : route('admin.educations.store') }}" class="space-y-4">
                    @csrf
                    @if ($editingEducation)
                        @method('PUT')
                    @endif

                    <x-admin.input label="Institusi" name="institution" :value="$editingEducation?->institution" required maxlength="150" placeholder="Contoh: SMKN 2 Banjarmasin" />
                    <div class="grid gap-4 sm:grid-cols-2">
                        <x-admin.input label="Jenjang" name="level" :value="$editingEducation?->level" maxlength="50" placeholder="SD / SMP / SMK" />
                        <x-admin.input label="Periode" name="period" :value="$editingEducation?->period" maxlength="100" placeholder="2024 - 2027" />
                    </div>
                    <x-admin.textarea label="Deskripsi" name="description" :value="$editingEducation?->description" :rows="3" maxlength="1000" placeholder="Keterangan singkat." />

                    <div class="flex items-center gap-2">
                        <button type="submit" class="flex flex-1 cursor-pointer items-center justify-center gap-2 rounded-xl bg-orange-600 px-4 py-2.5 text-xs font-semibold text-white transition-colors hover:bg-orange-500">
                            <x-icon :name="$editingEducation ? 'check-circle' : 'plus'" class="size-4" />
                            {{ $editingEducation ? 'Simpan' : 'Tambah' }}
                        </button>
                        @if ($editingEducation)
                            <a href="{{ route('admin.content.educations') }}" class="rounded-xl border border-surface-highest bg-background px-3 py-2.5 text-xs font-semibold text-on-surface">Batal</a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="min-w-0 rounded-lg border border-surface-highest bg-surface-low p-4 shadow-sm sm:p-5">
                <div class="mb-4 flex flex-wrap items-center justify-between gap-2">
                    <h2 class="text-base font-bold text-heading">Riwayat Pendidikan</h2>
                    <span class="rounded-full border border-surface-highest bg-surface-container px-2.5 py-1 font-mono text-[10px] text-on-surface-variant">{{ $educations->count() }} item</span>
                </div>
                <div class="space-y-2.5">
                    @forelse ($educations as $education)
                        <div class="flex items-start gap-3 rounded-xl border border-surface-highest bg-surface-container/40 p-3">
                            <span class="flex size-9 shrink-0 items-center justify-center rounded-lg border border-orange-500/30 bg-orange-500/10 text-orange-600 dark:text-orange-300">
                                <x-icon name="graduation-cap" class="size-4" />
                            </span>
                            <div class="min-w-0 flex-grow">
                                <p class="text-sm font-semibold text-heading">{{ $education->institution }}</p>
                                <p class="font-mono text-[10px] text-outline">{{ $education->level }}{{ $education->period ? ' • '.$education->period : '' }}</p>
                            </div>
                            <div class="flex shrink-0 items-center gap-1">
                                <a href="{{ route('admin.content.educations', ['edit_education' => $education->id]) }}" class="flex size-9 items-center justify-center rounded-lg text-on-surface-variant transition-colors hover:bg-surface-high hover:text-heading">
                                    <x-icon name="edit" class="size-3.5" />
                                </a>
                                <form method="POST" action="{{ route('admin.educations.destroy', $education) }}" data-confirm="Hapus riwayat pendidikan ini?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex size-9 cursor-pointer items-center justify-center rounded-lg text-on-surface-variant transition-colors hover:bg-red-500/10 hover:text-red-500">
                                        <x-icon name="trash" class="size-3.5" />
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="py-8 text-center text-sm text-on-surface-variant">Belum ada riwayat pendidikan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection
