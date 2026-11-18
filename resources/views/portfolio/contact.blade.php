@extends('layouts.app')

@section('title', 'Hubungi Saya | '.$profile->full_name)
@section('description', 'Hubungi '.$profile->full_name.' melalui email, GitHub, Instagram, LinkedIn, atau formulir kesan dan pesan.')

@section('content')
    <x-page-header
        badge="Hubungi"
        title="Hubungi Saya"
        description="Punya pertanyaan, tawaran kolaborasi, atau ingin meninggalkan kesan dan pesan? Silakan hubungi saya melalui salah satu kanal berikut."
    />

    <section class="mx-auto max-w-6xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[0.85fr_1.15fr]">
            <div class="space-y-4">
                @foreach ([
                    ['label' => 'Email', 'value' => $profile->email, 'icon' => 'mail', 'href' => $profile->email ? 'mailto:'.$profile->email : null, 'accent' => 'blue'],
                    ['label' => 'GitHub', 'value' => $profile->github_url ? preg_replace('#^https?://#', '', $profile->github_url) : null, 'icon' => 'github', 'href' => $profile->github_url, 'accent' => 'slate'],
                    ['label' => 'Instagram', 'value' => $profile->instagram_url ? '@'.ltrim(parse_url($profile->instagram_url, PHP_URL_PATH) ?? '', '/') : null, 'icon' => 'instagram', 'href' => $profile->instagram_url, 'accent' => 'pink'],
                    ['label' => 'LinkedIn', 'value' => $profile->linkedin_url ? preg_replace('#^https?://(www\.)?#', '', $profile->linkedin_url) : null, 'icon' => 'linkedin', 'href' => $profile->linkedin_url, 'accent' => 'cyan'],
                ] as $contact)
                    @if ($contact['value'])
                        <a
                            href="{{ $contact['href'] }}"
                            @if ($contact['href'] && str_starts_with($contact['href'], 'http')) target="_blank" rel="noopener noreferrer" @endif
                            class="flex items-center gap-4 rounded-lg border border-surface-highest bg-surface-low p-4 shadow-sm transition-all hover:-translate-y-0.5 hover:border-orange-500/40"
                        >
                            <span class="flex size-11 shrink-0 items-center justify-center rounded-xl border border-orange-500/30 bg-orange-500/10 text-orange-600 dark:text-orange-300">
                                <x-icon :name="$contact['icon']" class="size-5" />
                            </span>
                            <span class="min-w-0">
                                <span class="block font-mono text-[10px] uppercase tracking-widest text-outline">{{ $contact['label'] }}</span>
                                <span class="block truncate text-sm font-semibold text-heading">{{ $contact['value'] }}</span>
                            </span>
                            <x-icon name="arrow-up-right" class="ml-auto size-4 shrink-0 text-outline" />
                        </a>
                    @endif
                @endforeach

            </div>

            <div class="rounded-lg border border-surface-highest bg-surface-low p-6 shadow-sm sm:p-8">
                <div class="mb-6">
                    <span class="mb-2 inline-flex items-center gap-2 font-mono text-[10px] font-bold uppercase tracking-widest text-orange-600 dark:text-orange-300">
                        <x-icon name="message-square" class="size-3.5" />
                        Formulir Kesan &amp; Pesan
                    </span>
                    <h2 class="text-xl font-extrabold tracking-tight text-heading">Kirim Pesan</h2>
                    <p class="mt-1 text-sm text-on-surface-variant">Isi formulir di bawah ini. Pesan akan masuk ke dashboard admin.</p>
                </div>

                <form method="POST" action="{{ route('messages.store') }}" class="space-y-4">
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
                            <label for="email" class="mb-1.5 block text-xs font-semibold text-heading">Email <span class="text-red-500">*</span></label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                required
                                maxlength="150"
                                placeholder="nama@email.com"
                                @class([
                                    'w-full rounded-xl border bg-background px-3.5 py-2.5 text-sm text-on-surface outline-none transition-colors placeholder:text-outline focus:border-orange-500',
                                    'border-red-500/60' => $errors->has('email'),
                                    'border-surface-highest' => ! $errors->has('email'),
                                ])
                            >
                            @error('email')
                                <p class="mt-1 text-[11px] text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="subject" class="mb-1.5 block text-xs font-semibold text-heading">Subjek</label>
                        <input
                            id="subject"
                            name="subject"
                            type="text"
                            value="{{ old('subject') }}"
                            maxlength="150"
                            placeholder="Kolaborasi proyek, pertanyaan, atau feedback"
                            class="w-full rounded-xl border border-surface-highest bg-background px-3.5 py-2.5 text-sm text-on-surface outline-none transition-colors placeholder:text-outline focus:border-orange-500"
                        >
                        @error('subject')
                            <p class="mt-1 text-[11px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="message" class="mb-1.5 block text-xs font-semibold text-heading">Kesan &amp; Pesan <span class="text-red-500">*</span></label>
                        <textarea
                            id="message"
                            name="message"
                            rows="6"
                            required
                            maxlength="3000"
                            placeholder="Tulis kesan, pesan, pertanyaan, atau tawaran kolaborasi..."
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

                    <div class="flex flex-col items-start justify-between gap-3 pt-1 sm:flex-row sm:items-center">
                        <p class="text-[11px] leading-relaxed text-outline">Data hanya digunakan untuk membalas pesanmu.</p>
                        <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-full bg-orange-800 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-orange-600/25 transition-all hover:-translate-y-0.5 hover:from-orange-500 hover:to-orange-500 sm:w-auto">
                            <x-icon name="send" class="size-4" />
                            Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
