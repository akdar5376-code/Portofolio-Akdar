@extends('layouts.app')

@section('title', 'Testimoni | '.$profile->full_name)
@section('description', 'Kirim dan lihat testimoni dari siswa, guru, pengguna, serta tempat magang tentang '.$profile->full_name.'.')

@section('content')
    <x-page-header
        badge="Penilaian"
        title="Testimoni"
        description="Kirimkan pesan dan kesanmu, lalu lihat testimoni dari siswa, guru, pengguna, serta tempat magang."
    />

    <section class="mx-auto max-w-5xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="rounded-2xl border border-surface-highest bg-surface-low p-6 shadow-card-dark sm:p-8">
            <div class="mb-6">
                <span class="mb-2 inline-flex items-center gap-2 font-mono text-[10px] font-bold uppercase tracking-widest text-blue-600 dark:text-blue-300">
                    <x-icon name="message-square" class="size-3.5" />
                    Formulir Testimoni
                </span>
                <h2 class="text-xl font-extrabold tracking-tight text-heading">Tulis Testimoni</h2>
                <p class="mt-1 text-sm text-on-surface-variant">Pilih kategori yang sesuai, lalu tuliskan pesan atau kesanmu.</p>
            </div>

            <form method="POST" action="{{ route('testimonies.store') }}" class="space-y-4">
                @csrf

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="name" class="mb-1.5 block text-xs font-semibold text-heading">Nama <span class="text-red-500">*</span></label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            required
                            maxlength="100"
                            placeholder="Nama kamu"
                            @class([
                                'w-full rounded-xl border bg-background px-3.5 py-2.5 text-sm text-on-surface outline-none transition-colors placeholder:text-outline focus:border-blue-500',
                                'border-red-500/60' => $errors->has('name'),
                                'border-surface-highest' => ! $errors->has('name'),
                            ])
                        >
                        @error('name')
                            <p class="mt-1 text-[11px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="role" class="mb-1.5 block text-xs font-semibold text-heading">Kategori <span class="text-red-500">*</span></label>
                        <select
                            id="role"
                            name="role"
                            required
                            @class([
                                'w-full rounded-xl border bg-background px-3.5 py-2.5 text-sm text-on-surface outline-none transition-colors focus:border-blue-500',
                                'border-red-500/60' => $errors->has('role'),
                                'border-surface-highest' => ! $errors->has('role'),
                            ])
                        >
                            <option value="">Pilih kategori</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->value }}" @selected(old('role') === $role->value)>{{ $role->label() }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <p class="mt-1 text-[11px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="message" class="mb-1.5 block text-xs font-semibold text-heading">Pesan / Testimoni <span class="text-red-500">*</span></label>
                    <textarea
                        id="message"
                        name="message"
                        rows="5"
                        required
                        minlength="10"
                        maxlength="1000"
                        placeholder="Tulis kesan, penilaian, atau pesanmu..."
                        @class([
                            'w-full resize-y rounded-xl border bg-background px-3.5 py-3 text-sm text-on-surface outline-none transition-colors placeholder:text-outline focus:border-blue-500',
                            'border-red-500/60' => $errors->has('message'),
                            'border-surface-highest' => ! $errors->has('message'),
                        ])
                    >{{ old('message') }}</textarea>
                    @error('message')
                        <p class="mt-1 text-[11px] text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end pt-1">
                    <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/25 transition-all hover:-translate-y-0.5 hover:from-blue-500 hover:to-indigo-500 sm:w-auto">
                        <x-icon name="send" class="size-4" />
                        Kirim Testimoni
                    </button>
                </div>
            </form>
        </div>
    </section>

    <section class="mx-auto max-w-7xl border-t border-surface-highest/50 px-4 py-16 sm:px-6 lg:px-8">
        <div class="mb-6 flex flex-wrap items-center gap-2">
            <span class="flex size-9 items-center justify-center rounded-xl border border-blue-500/30 bg-blue-500/10 text-blue-600 dark:text-blue-300">
                <x-icon name="quote" class="size-4" />
            </span>
            <div>
                <h2 class="text-xl font-extrabold tracking-tight text-heading">Daftar Testimoni</h2>
                <p class="text-xs text-on-surface-variant">Pesan yang masuk dari siswa, guru, pengguna, dan tempat magang.</p>
            </div>
            <span class="ml-auto rounded-full border border-surface-highest bg-surface-container px-2.5 py-1 font-mono text-[10px] text-on-surface-variant">{{ $testimonies->count() }} testimoni</span>
        </div>

        <div class="overflow-hidden rounded-2xl border border-surface-highest bg-surface-low shadow-card-dark">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[720px] border-collapse text-left text-sm">
                    <thead>
                        <tr class="border-b border-surface-highest bg-surface-container/60 font-mono text-[10px] uppercase tracking-widest text-outline">
                            <th class="w-12 px-4 py-3.5 text-center font-semibold">No</th>
                            <th class="w-48 px-4 py-3.5 font-semibold">Nama</th>
                            <th class="w-36 px-4 py-3.5 font-semibold">Kategori</th>
                            <th class="px-4 py-3.5 font-semibold">Pesan</th>
                            <th class="w-32 px-4 py-3.5 font-semibold">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-highest">
                        @forelse ($testimonies as $testimony)
                            @php
                                $accent = $testimony->role->accentClasses();
                            @endphp
                            <tr class="align-top transition-colors hover:bg-surface-container/40">
                                <td class="px-4 py-4 text-center font-mono text-xs text-outline">{{ $loop->iteration }}</td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-2.5">
                                        <span class="flex size-8 shrink-0 items-center justify-center rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 font-mono text-[10px] font-bold text-white">{{ $testimony->initials }}</span>
                                        <span class="font-semibold text-heading">{{ $testimony->name }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center gap-1.5 rounded-full border px-2.5 py-1 font-mono text-[10px] font-bold uppercase tracking-wider {{ $accent['badge'] }}">
                                        <x-icon :name="$testimony->role->icon()" class="size-3" />
                                        {{ $testimony->role->label() }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 leading-relaxed text-on-surface-variant">{{ $testimony->message }}</td>
                                <td class="px-4 py-4 font-mono text-[11px] text-outline">{{ $testimony->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-14 text-center">
                                    <div class="mx-auto mb-3 flex size-14 items-center justify-center rounded-2xl border border-surface-highest bg-surface-high text-blue-500">
                                        <x-icon name="quote" class="size-7" />
                                    </div>
                                    <p class="text-sm font-semibold text-heading">Belum ada testimoni.</p>
                                    <p class="mt-1 text-xs text-on-surface-variant">Jadilah yang pertama mengirimkan testimoni melalui formulir di atas.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
