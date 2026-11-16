@extends('layouts.admin-app')

@section('title', 'Kelola Profil')
@section('heading', 'Kelola Profil')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-extrabold tracking-tight text-heading">Informasi Profil</h2>
        <p class="mt-1 text-sm text-on-surface-variant">Perbarui identitas, kontak, dan deskripsi yang tampil di seluruh halaman website.</p>
    </div>

    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="grid items-start gap-6 xl:grid-cols-[1fr_360px]">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <section class="rounded-2xl border border-surface-highest bg-surface-low p-5 shadow-card-dark sm:p-6">
                <h3 class="mb-4 flex items-center gap-2 border-b border-surface-highest pb-3 text-base font-bold text-heading">
                    <x-icon name="user" class="size-4 text-blue-500" />
                    Identitas
                </h3>
                <div class="grid gap-4 sm:grid-cols-2">
                    <x-admin.input label="Nama Lengkap" name="full_name" :value="$profile->full_name" required maxlength="150" />
                    <x-admin.input label="Peran / Profesi" name="role" :value="$profile->role" maxlength="150" placeholder="Junior Developer" />
                    <x-admin.input label="Kelas" name="class_name" :value="$profile->class_name" maxlength="100" placeholder="XII RPL 1" />
                    <x-admin.input label="Kompetensi Keahlian" name="competency" :value="$profile->competency" maxlength="150" placeholder="Rekayasa Perangkat Lunak" />
                </div>
                <div class="mt-4">
                    <x-admin.input label="Tagline / Motto" name="tagline" :value="$profile->tagline" maxlength="200" placeholder="Membangun solusi digital melalui kode yang bersih dan efisien." />
                </div>
            </section>

            <section class="rounded-2xl border border-surface-highest bg-surface-low p-5 shadow-card-dark sm:p-6">
                <h3 class="mb-4 flex items-center gap-2 border-b border-surface-highest pb-3 text-base font-bold text-heading">
                    <x-icon name="file-text" class="size-4 text-indigo-500" />
                    Deskripsi &amp; Tujuan
                </h3>
                <div class="space-y-4">
                    <x-admin.textarea label="Biodata Singkat" name="bio" :value="$profile->bio" :rows="4" maxlength="5000" placeholder="Ceritakan tentang dirimu." />
                    <x-admin.textarea label="Cita-cita / Tujuan Karir" name="career_goal" :value="$profile->career_goal" :rows="3" maxlength="5000" placeholder="Tujuan karir ke depan." />
                    <x-admin.textarea label="Minat & Bidang Teknologi" name="interests" :value="$profile->interests" :rows="2" maxlength="2000" hint="Pisahkan dengan koma" placeholder="Web Development, IoT, UI/UX" />
                </div>
            </section>
        </div>

        <aside class="space-y-6">
            <section class="rounded-2xl border border-surface-highest bg-surface-low p-5 shadow-card-dark">
                <h3 class="mb-4 text-sm font-bold text-heading">Foto Profil</h3>
                <div class="overflow-hidden rounded-xl border border-surface-highest bg-surface-container">
                    @if ($profile->avatar_url)
                        <img src="{{ $profile->avatar_url }}" alt="{{ $profile->full_name }}" class="aspect-square w-full object-contain">
                    @else
                        <div class="flex aspect-square w-full items-center justify-center">
                            <x-icon name="user" class="size-16 text-outline" />
                        </div>
                    @endif
                </div>

                <label for="avatar" class="mt-3 flex cursor-pointer items-center justify-center gap-2 rounded-xl border border-dashed border-surface-highest bg-background px-3 py-3 text-center transition-colors hover:border-blue-500/60">
                    <x-icon name="upload" class="size-4 text-outline" />
                    <span id="avatar-filename" class="font-mono text-[10px] text-blue-500">Pilih foto JPG, PNG, atau WEBP (maks. 4 MB)</span>
                    <input id="avatar" name="avatar" type="file" accept="image/jpeg,image/png,image/webp" data-filename-target="#avatar-filename" class="sr-only">
                </label>
                @error('avatar')
                    <p class="mt-1 text-[11px] text-red-500">{{ $message }}</p>
                @enderror

                @if ($profile->avatar_path)
                    <label class="mt-2 flex cursor-pointer items-center gap-1.5 text-red-500">
                        <input type="checkbox" name="remove_avatar" value="1" class="size-4 accent-red-500">
                        <span class="font-mono text-[10px]">Hapus foto profil</span>
                    </label>
                @endif
            </section>

            <section class="rounded-2xl border border-surface-highest bg-surface-low p-5 shadow-card-dark">
                <h3 class="mb-4 text-sm font-bold text-heading">File CV (PDF)</h3>
                @if ($profile->cv_path)
                    <div class="mb-3 flex items-center gap-2 rounded-xl border border-surface-highest bg-surface-container/50 p-3">
                        <x-icon name="file-text" class="size-5 text-blue-500" />
                        <span class="min-w-0 flex-grow truncate font-mono text-[10px] text-on-surface-variant">{{ basename($profile->cv_path) }}</span>
                        <a href="{{ $profile->cv_url }}" target="_blank" rel="noopener noreferrer" class="text-blue-600 dark:text-blue-300">
                            <x-icon name="external-link" class="size-4" />
                        </a>
                    </div>
                @endif

                <label for="cv" class="flex cursor-pointer items-center justify-center gap-2 rounded-xl border border-dashed border-surface-highest bg-background px-3 py-3 text-center transition-colors hover:border-blue-500/60">
                    <x-icon name="upload" class="size-4 text-outline" />
                    <span id="cv-filename" class="font-mono text-[10px] text-blue-500">Pilih file PDF (maks 8MB)</span>
                    <input id="cv" name="cv" type="file" accept="application/pdf" data-filename-target="#cv-filename" class="sr-only">
                </label>
                @error('cv')
                    <p class="mt-1 text-[11px] text-red-500">{{ $message }}</p>
                @enderror

                @if ($profile->cv_path)
                    <label class="mt-2 flex cursor-pointer items-center gap-1.5 text-red-500">
                        <input type="checkbox" name="remove_cv" value="1" class="size-4 accent-red-500">
                        <span class="font-mono text-[10px]">Hapus file CV</span>
                    </label>
                @endif
            </section>

            <section class="rounded-2xl border border-surface-highest bg-surface-low p-5 shadow-card-dark">
                <h3 class="mb-4 flex items-center gap-2 border-b border-surface-highest pb-3 text-sm font-bold text-heading">
                    <x-icon name="mail" class="size-4 text-emerald-500" />
                    Kontak &amp; Media Sosial
                </h3>
                <div class="space-y-4">
                    <x-admin.input label="Email" name="email" type="email" :value="$profile->email" maxlength="150" placeholder="nama@email.com" />
                    <x-admin.input label="Link GitHub" name="github_url" type="url" :value="$profile->github_url" maxlength="2048" placeholder="https://github.com/username" />
                    <x-admin.input label="Link Instagram" name="instagram_url" type="url" :value="$profile->instagram_url" maxlength="2048" placeholder="https://instagram.com/username" />
                    <x-admin.input label="Link LinkedIn" name="linkedin_url" type="url" :value="$profile->linkedin_url" maxlength="2048" placeholder="https://linkedin.com/in/username" />
                </div>
            </section>

            <button type="submit" class="flex w-full cursor-pointer items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/25 transition-all hover:from-blue-500 hover:to-indigo-500">
                <x-icon name="check-circle" class="size-4" />
                Simpan Profil
            </button>
        </aside>
    </form>
@endsection
