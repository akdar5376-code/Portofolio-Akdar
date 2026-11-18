@extends('layouts.app')

@section('title', 'Testimoni | '.$profile->full_name)
@section('description', 'Kirim pesan dan testimoni tentang '.$profile->full_name.'.')

@section('content')
    <x-page-header
        badge="Penilaian"
        title="Testimoni"
        description="Kirimkan pesan dan kesanmu melalui formulir berikut."
    />

    <section id="form-testimoni" class="mx-auto max-w-5xl scroll-mt-24 px-4 py-16 sm:px-6 lg:px-8">
        <div class="rounded-lg border border-surface-highest bg-surface-low p-6 shadow-sm sm:p-8">
            <div class="mb-6">
                <span class="mb-2 inline-flex items-center gap-2 font-mono text-[10px] font-bold uppercase tracking-widest text-orange-600 dark:text-orange-300">
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
                                'w-full rounded-xl border bg-background px-3.5 py-2.5 text-sm text-on-surface outline-none transition-colors placeholder:text-outline focus:border-orange-500',
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
                                'w-full rounded-xl border bg-background px-3.5 py-2.5 text-sm text-on-surface outline-none transition-colors focus:border-orange-500',
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
                            'w-full resize-y rounded-xl border bg-background px-3.5 py-3 text-sm text-on-surface outline-none transition-colors placeholder:text-outline focus:border-orange-500',
                            'border-red-500/60' => $errors->has('message'),
                            'border-surface-highest' => ! $errors->has('message'),
                        ])
                    >{{ old('message') }}</textarea>
                    @error('message')
                        <p class="mt-1 text-[11px] text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end pt-1">
                    <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-full bg-orange-800 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-orange-600/25 transition-all hover:-translate-y-0.5 hover:from-orange-500 hover:to-orange-500 sm:w-auto">
                        <x-icon name="send" class="size-4" />
                        Kirim Testimoni
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
