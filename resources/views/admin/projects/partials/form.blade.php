<form
    method="POST"
    action="{{ $editing ? route('admin.projects.update', $editing) : route('admin.projects.store') }}"
    enctype="multipart/form-data"
    class="min-w-0 space-y-4"
>
    @csrf
    @if ($editing)
        @method('PUT')
    @endif

    <x-admin.input label="Nama Proyek" name="title" :value="$editing?->title" required maxlength="150" placeholder="Contoh: Sistem Informasi Akademik" />

    <x-admin.input label="Kategori" name="category" :value="$editing?->category" required maxlength="100" placeholder="Contoh: Web Development, Mobile, IoT" />

    <x-admin.textarea label="Deskripsi Singkat" name="description" :value="$editing?->description" :rows="3" maxlength="300" hint="Maks. 300 karakter" placeholder="Ringkasan proyek yang tampil di kartu galeri." />

    <div>
        <label for="thumbnail" class="mb-1.5 flex items-center justify-between text-xs font-semibold text-heading">
            <span>Foto / Screenshot Proyek</span>
            <span class="font-mono text-[10px] font-normal text-outline">JPG, PNG, WEBP • maks 4MB</span>
        </label>
        <label for="thumbnail" class="flex cursor-pointer flex-col items-center justify-center gap-1.5 rounded-xl border border-dashed border-surface-highest bg-background px-3 py-5 text-center transition-colors hover:border-orange-500/60">
            <x-icon name="image" class="size-6 text-outline" />
            <span class="text-xs font-medium text-on-surface-variant">Klik untuk memilih gambar</span>
            <span id="thumbnail-filename" class="font-mono text-[10px] text-orange-500">
                {{ $editing?->thumbnail_path ? 'Kosongkan untuk mempertahankan gambar saat ini' : 'Belum ada file dipilih' }}
            </span>
            <input
                id="thumbnail"
                name="thumbnail"
                type="file"
                accept="image/jpeg,image/png,image/webp"
                data-filename-target="#thumbnail-filename"
                class="sr-only"
            >
        </label>
        @error('thumbnail')
            <p class="mt-1 text-[11px] text-red-500">{{ $message }}</p>
        @enderror

        @if ($editing?->thumbnail_path)
            <div class="mt-2 flex items-center gap-3 rounded-xl border border-surface-highest bg-surface-container/50 p-2.5">
                <img src="{{ $editing->thumbnail_url }}" alt="{{ $editing->title }}" class="h-12 w-20 shrink-0 rounded-lg border border-surface-highest object-cover">
                <div class="min-w-0 flex-grow text-[11px] text-on-surface-variant">
                    <p class="font-semibold text-heading">Gambar saat ini</p>
                    <p class="font-mono text-[10px]">Pilih file baru untuk mengganti.</p>
                </div>
                <label class="flex shrink-0 cursor-pointer items-center gap-1.5 text-red-500">
                    <input type="checkbox" name="remove_thumbnail" value="1" class="size-4 accent-red-500">
                    <span class="font-mono text-[10px]">Hapus</span>
                </label>
            </div>
        @endif
    </div>

    <div class="grid gap-4 sm:grid-cols-2">
        <x-admin.input label="Link Demo" name="project_url" type="url" :value="$editing?->project_url" maxlength="2048" placeholder="https://demo.example.com" />
        <x-admin.input label="Link GitHub" name="github_url" type="url" :value="$editing?->github_url" maxlength="2048" placeholder="https://github.com/..." />
    </div>

    <x-admin.input label="Peran dalam Proyek" name="role" :value="$editing?->role" maxlength="150" placeholder="Contoh: Full Stack Developer" />

    <x-admin.checkbox label="Tandai sebagai proyek unggulan" name="is_featured" :checked="$editing?->is_featured" />

    <details class="rounded-xl border border-surface-highest bg-surface-container/30 p-3 sm:p-4">
        <summary class="cursor-pointer text-xs font-bold uppercase tracking-wider text-on-surface-variant">Detail &amp; Dokumentasi Proyek</summary>
        <div class="mt-4 space-y-4">
            <x-admin.textarea label="Detail Proyek" name="detail" :value="$editing?->detail" :rows="4" maxlength="5000" placeholder="Ceritakan gambaran lengkap proyek." />
            <div class="grid gap-4 sm:grid-cols-2">
                <x-admin.textarea label="Permasalahan" name="problem" :value="$editing?->problem" :rows="4" maxlength="2000" placeholder="Masalah yang ingin diselesaikan." />
                <x-admin.textarea label="Tujuan" name="goal" :value="$editing?->goal" :rows="4" maxlength="2000" placeholder="Tujuan dibuatnya proyek." />
            </div>
            <x-admin.input label="Teknologi yang Digunakan" name="tech_stack" :value="$editing?->tech_stack" maxlength="500" hint="Pisahkan dengan koma" placeholder="Laravel, Tailwind CSS, MySQL" />
            <x-admin.textarea label="Fitur-Fitur" name="features" :value="$editing?->features" :rows="4" maxlength="5000" hint="Satu fitur per baris" placeholder="Autentikasi pengguna&#10;Dashboard admin&#10;Laporan otomatis" />
            <x-admin.textarea label="Dokumentasi Proses Pekerjaan" name="process" :value="$editing?->process" :rows="4" maxlength="5000" hint="Satu tahap per baris" placeholder="Analisis kebutuhan&#10;Desain antarmuka&#10;Implementasi" />
            <x-admin.textarea label="Feedback Pengguna" name="user_feedback" :value="$editing?->user_feedback" :rows="3" maxlength="2000" placeholder="Kutipan feedback dari pengguna proyek." />
        </div>
    </details>

    <div class="flex items-center gap-2 pt-1">
        <button type="submit" class="flex flex-1 cursor-pointer items-center justify-center gap-2 rounded-xl bg-orange-800 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-orange-600/25 transition-all hover:from-orange-500 hover:to-orange-500">
            <x-icon :name="$editing ? 'check-circle' : 'plus-circle'" class="size-4" />
            {{ $editing ? 'Simpan Perubahan' : 'Publikasikan Proyek' }}
        </button>

        @if ($editing)
            <a href="{{ route('admin.projects.index') }}#form" class="flex shrink-0 items-center justify-center gap-2 rounded-xl border border-surface-highest bg-background px-4 py-3 text-sm font-semibold text-on-surface transition-colors hover:bg-surface-container">
                <x-icon name="refresh" class="size-4" />
                Batal
            </a>
        @endif
    </div>
</form>
