<form
    method="POST"
    action="{{ $editing ? route('admin.posts.update', $editing) : route('admin.posts.store') }}"
    enctype="multipart/form-data"
    class="space-y-4"
>
    @csrf
    @if ($editing)
        @method('PUT')
    @endif

    <x-admin.input label="Judul Artikel" name="title" :value="$editing?->title" required maxlength="150" placeholder="Contoh: Menjaga Controller Laravel Tetap Ramping" />

    <x-admin.select label="Kategori" name="category" :options="$categoryOptions" :value="$editing?->category?->value ?? \App\Enums\PostCategory::Artikel->value" required />

    <x-admin.textarea label="Ringkasan / Excerpt" name="excerpt" :value="$editing?->excerpt" :rows="3" maxlength="300" hint="Maks. 300 karakter" placeholder="Ringkasan singkat yang tampil di kartu blog." />

    <div>
        <label for="cover" class="mb-1.5 flex items-center justify-between text-xs font-semibold text-heading">
            <span>Gambar Sampul</span>
            <span class="font-mono text-[10px] font-normal text-outline">JPG, PNG, WEBP &bull; maks 4MB</span>
        </label>
        <label for="cover" class="flex cursor-pointer flex-col items-center justify-center gap-1.5 rounded-xl border border-dashed border-surface-highest bg-background px-3 py-5 text-center transition-colors hover:border-blue-500/60">
            <x-icon name="image" class="size-6 text-outline" />
            <span class="text-xs font-medium text-on-surface-variant">Klik untuk memilih gambar</span>
            <span id="cover-filename" class="font-mono text-[10px] text-blue-500">
                {{ $editing?->cover_path ? 'Kosongkan untuk mempertahankan gambar saat ini' : 'Belum ada file dipilih' }}
            </span>
            <input
                id="cover"
                name="cover"
                type="file"
                accept="image/jpeg,image/png,image/webp"
                data-filename-target="#cover-filename"
                class="sr-only"
            >
        </label>
        @error('cover')
            <p class="mt-1 text-[11px] text-red-500">{{ $message }}</p>
        @enderror

        @if ($editing?->cover_path)
            <div class="mt-2 flex items-center gap-3 rounded-xl border border-surface-highest bg-surface-container/50 p-2.5">
                <img src="{{ $editing->cover_url }}" alt="{{ $editing->title }}" class="h-12 w-20 shrink-0 rounded-lg border border-surface-highest object-cover">
                <div class="min-w-0 flex-grow text-[11px] text-on-surface-variant">
                    <p class="font-semibold text-heading">Gambar saat ini</p>
                    <p class="font-mono text-[10px]">Pilih file baru untuk mengganti.</p>
                </div>
                <label class="flex shrink-0 cursor-pointer items-center gap-1.5 text-red-500">
                    <input type="checkbox" name="remove_cover" value="1" class="size-4 accent-red-500">
                    <span class="font-mono text-[10px]">Hapus</span>
                </label>
            </div>
        @endif
    </div>

    <x-admin.input label="Tag" name="tags" :value="$editing?->tags" maxlength="500" hint="Pisahkan dengan koma" placeholder="Laravel, Eloquent, Performa" />

    <div class="grid gap-4 sm:grid-cols-2">
        <x-admin.input label="Tanggal Terbit" name="published_at" type="datetime-local" :value="$editing?->published_at?->format('Y-m-d\TH:i')" hint="Opsional" />
        <div class="flex items-end">
            <x-admin.checkbox label="Terbitkan artikel" name="is_published" :checked="$editing?->is_published" class="w-full" />
        </div>
    </div>

    <x-admin.textarea
        label="Isi Artikel"
        name="body"
        :value="$editing?->body"
        :rows="16"
        required
        maxlength="50000"
        hint="Markdown didukung"
        placeholder="# Judul bagian&#10;&#10;Tulis isi artikel di sini. Gunakan **tebal**, `kode`, dan blok kode dengan tiga backtick."
        class="font-mono text-[13px]"
    />

    <div class="flex items-center gap-2 pt-1">
        <button type="submit" class="flex flex-1 cursor-pointer items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/25 transition-all hover:from-blue-500 hover:to-indigo-500">
            <x-icon :name="$editing ? 'check-circle' : 'plus-circle'" class="size-4" />
            {{ $editing ? 'Simpan Perubahan' : 'Simpan Artikel' }}
        </button>

        @if ($editing)
            <a href="{{ route('admin.posts.index') }}#form" class="flex shrink-0 items-center justify-center gap-2 rounded-xl border border-surface-highest bg-background px-4 py-3 text-sm font-semibold text-on-surface transition-colors hover:bg-surface-container">
                <x-icon name="refresh" class="size-4" />
                Batal
            </a>
        @endif
    </div>
</form>
