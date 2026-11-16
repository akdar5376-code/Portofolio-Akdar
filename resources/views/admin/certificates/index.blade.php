@extends('layouts.admin-app')

@section('title', 'Kelola Sertifikat')
@section('heading', 'Kelola Sertifikat')

@section('content')
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div>
            <h2 class="text-2xl font-extrabold tracking-tight text-heading">Sertifikat &amp; Prestasi</h2>
            <p class="mt-1 text-sm text-on-surface-variant">Tambah, ubah, dan hapus sertifikat beserta dokumentasinya.</p>
        </div>
        @if ($editing)
            <a href="{{ route('admin.certificates.index') }}" class="flex items-center justify-center gap-2 rounded-full border border-surface-highest bg-surface-low px-4 py-2.5 text-xs font-semibold text-on-surface transition-colors hover:border-blue-500/40">
                <x-icon name="plus" class="size-4" />
                Tambah Sertifikat Baru
            </a>
        @endif
    </div>

    <div class="grid items-start gap-6 xl:grid-cols-[minmax(0,420px)_1fr]">
        <section class="rounded-2xl border border-surface-highest bg-surface-low p-5 shadow-card-dark sm:p-6">
            <div class="mb-5 border-b border-surface-highest pb-4">
                <h2 class="flex items-center gap-2 text-base font-bold text-heading">
                    <x-icon :name="$editing ? 'edit' : 'plus-circle'" class="size-4 text-blue-500" />
                    {{ $editing ? 'Edit Sertifikat' : 'Tambah Sertifikat' }}
                </h2>
                <p class="mt-1 text-xs text-on-surface-variant">Unggah gambar dokumentasi bila tersedia.</p>
            </div>

            <form
                method="POST"
                action="{{ $editing ? route('admin.certificates.update', $editing) : route('admin.certificates.store') }}"
                enctype="multipart/form-data"
                class="space-y-4"
            >
                @csrf
                @if ($editing)
                    @method('PUT')
                @endif

                <x-admin.input label="Judul Sertifikat" name="title" :value="$editing?->title" required maxlength="150" placeholder="Contoh: Sertifikat Junior Web Developer" />

                <div class="grid gap-4 sm:grid-cols-2">
                    <x-admin.input label="Penerbit" name="issuer" :value="$editing?->issuer" maxlength="150" placeholder="BNSP / Dicoding" />
                    <x-admin.input label="Tahun" name="year" :value="$editing?->year" maxlength="20" placeholder="2026" />
                </div>

                <x-admin.input label="Link Kredensial" name="credential_url" type="url" :value="$editing?->credential_url" maxlength="2048" placeholder="https://..." />

                <x-admin.textarea label="Deskripsi" name="description" :value="$editing?->description" :rows="3" maxlength="1000" placeholder="Keterangan singkat sertifikat atau prestasi." />

                <div>
                    <label for="image" class="mb-1.5 flex items-center justify-between text-xs font-semibold text-heading">
                        <span>Dokumentasi Sertifikat</span>
                        <span class="font-mono text-[10px] font-normal text-outline">JPG, PNG, WEBP • maks 4MB</span>
                    </label>
                    <label for="image" class="flex cursor-pointer flex-col items-center justify-center gap-1.5 rounded-xl border border-dashed border-surface-highest bg-background px-3 py-5 text-center transition-colors hover:border-blue-500/60">
                        <x-icon name="upload" class="size-6 text-outline" />
                        <span class="text-xs font-medium text-on-surface-variant">Pilih gambar dokumentasi</span>
                        <span id="certificate-filename" class="font-mono text-[10px] text-blue-500">{{ $editing?->image_path ? 'Kosongkan untuk mempertahankan gambar' : 'Belum ada file dipilih' }}</span>
                        <input id="image" name="image" type="file" accept="image/jpeg,image/png,image/webp" data-filename-target="#certificate-filename" class="sr-only">
                    </label>
                    @error('image')
                        <p class="mt-1 text-[11px] text-red-500">{{ $message }}</p>
                    @enderror

                    @if ($editing?->image_path)
                        <div class="mt-2 flex items-center gap-3 rounded-xl border border-surface-highest bg-surface-container/50 p-2.5">
                            <img src="{{ $editing->image_url }}" alt="{{ $editing->title }}" class="h-12 w-16 shrink-0 rounded-lg border border-surface-highest object-cover">
                            <span class="min-w-0 flex-grow text-[11px] text-on-surface-variant">Gambar dokumentasi saat ini</span>
                            <label class="flex shrink-0 cursor-pointer items-center gap-1.5 text-red-500">
                                <input type="checkbox" name="remove_image" value="1" class="size-4 accent-red-500">
                                <span class="font-mono text-[10px]">Hapus</span>
                            </label>
                        </div>
                    @endif
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <button type="submit" class="flex flex-1 cursor-pointer items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/25 transition-all hover:from-blue-500 hover:to-indigo-500">
                        <x-icon :name="$editing ? 'check-circle' : 'plus-circle'" class="size-4" />
                        {{ $editing ? 'Simpan Perubahan' : 'Tambah Sertifikat' }}
                    </button>
                    @if ($editing)
                        <a href="{{ route('admin.certificates.index') }}" class="flex shrink-0 items-center justify-center gap-2 rounded-xl border border-surface-highest bg-background px-4 py-3 text-sm font-semibold text-on-surface transition-colors hover:bg-surface-container">
                            <x-icon name="refresh" class="size-4" />
                            Batal
                        </a>
                    @endif
                </div>
            </form>
        </section>

        <section class="rounded-2xl border border-surface-highest bg-surface-low p-5 shadow-card-dark sm:p-6">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="flex items-center gap-2 text-base font-bold text-heading">
                    <x-icon name="award" class="size-4 text-amber-500" />
                    Daftar Sertifikat
                </h2>
                <span class="rounded-full border border-surface-highest bg-surface-container px-2.5 py-1 font-mono text-[10px] text-on-surface-variant">{{ $certificates->count() }} item</span>
            </div>

            <div class="grid gap-3 sm:grid-cols-2">
                @forelse ($certificates as $certificate)
                    <div class="flex gap-3 rounded-xl border border-surface-highest bg-surface-container/40 p-3">
                        @if ($certificate->image_url)
                            <img src="{{ $certificate->image_url }}" alt="{{ $certificate->title }}" class="h-16 w-20 shrink-0 rounded-lg border border-surface-highest object-cover">
                        @else
                            <div class="flex h-16 w-20 shrink-0 items-center justify-center rounded-lg border border-blue-500/30 bg-blue-500/10 text-blue-500 dark:text-blue-300">
                                <x-icon name="award" class="size-6" />
                            </div>
                        @endif
                        <div class="min-w-0 flex-grow">
                            <p class="line-clamp-2 text-sm font-semibold text-heading">{{ $certificate->title }}</p>
                            <p class="mt-0.5 font-mono text-[10px] text-outline">{{ $certificate->issuer }}{{ $certificate->year ? ' • '.$certificate->year : '' }}</p>
                            <div class="mt-2 flex items-center gap-1">
                                <a href="{{ route('admin.certificates.index', ['edit' => $certificate->id]) }}#form" class="flex size-7 items-center justify-center rounded-lg text-on-surface-variant transition-colors hover:bg-surface-high hover:text-heading">
                                    <x-icon name="edit" class="size-3.5" />
                                </a>
                                <form method="POST" action="{{ route('admin.certificates.destroy', $certificate) }}" data-confirm="Hapus sertifikat ini?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex size-7 cursor-pointer items-center justify-center rounded-lg text-on-surface-variant transition-colors hover:bg-red-500/10 hover:text-red-500">
                                        <x-icon name="trash" class="size-3.5" />
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-10 text-center">
                        <x-icon name="award" class="mx-auto mb-2 size-8 text-outline" />
                        <p class="text-sm font-semibold text-heading">Belum ada sertifikat.</p>
                        <p class="mt-1 text-xs text-on-surface-variant">Tambahkan sertifikat pertama lewat form.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
@endsection
