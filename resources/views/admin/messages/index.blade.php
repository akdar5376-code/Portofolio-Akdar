@extends('layouts.admin-app')

@section('title', 'Pesan Kontak')
@section('heading', 'Pesan Kontak')

@section('content')
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div>
            <h2 class="text-2xl font-extrabold tracking-tight text-heading">Pesan dari Formulir Kontak</h2>
            <p class="mt-1 text-sm text-on-surface-variant">Pesan yang dikirim pengunjung melalui formulir kontak.</p>
        </div>
        <span class="flex items-center gap-2 self-start rounded-full border border-surface-highest bg-surface-low px-4 py-2 font-mono text-xs text-on-surface-variant sm:self-auto">
            <span class="size-1.5 rounded-full bg-red-500"></span>
            {{ $unreadCount }} belum dibaca
        </span>
    </div>

    <div class="space-y-3">
        @forelse ($messages as $message)
            <article class="rounded-lg border bg-surface-low p-5 shadow-sm {{ $message->is_read ? 'border-surface-highest' : 'border-orange-500/40' }}">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-start">
                    <div class="flex size-10 shrink-0 items-center justify-center border border-orange-700/30 bg-orange-700/10 font-mono text-xs font-bold text-orange-900 dark:text-orange-300">
                        {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($message->name, 0, 2)) }}
                    </div>

                    <div class="min-w-0 flex-grow">
                        <div class="flex flex-wrap items-center gap-2">
                            <h3 class="text-sm font-bold text-heading">{{ $message->name }}</h3>
                            @if (! $message->is_read)
                                <span class="rounded-full bg-red-500/10 px-2 py-0.5 font-mono text-[9px] font-bold uppercase tracking-wider text-red-500">Baru</span>
                            @else
                                <span class="rounded-full bg-surface-container px-2 py-0.5 font-mono text-[9px] font-bold uppercase tracking-wider text-outline">Dibaca</span>
                            @endif
                            <span class="font-mono text-[10px] text-outline">{{ $message->created_at->translatedFormat('d M Y, H:i') }}</span>
                        </div>
                        <a href="mailto:{{ $message->email }}" class="mt-0.5 inline-flex items-center gap-1 text-xs text-orange-600 hover:underline dark:text-orange-300">
                            <x-icon name="mail" class="size-3" />
                            {{ $message->email }}
                        </a>

                        <p class="mt-2 text-xs font-semibold uppercase tracking-wide text-outline">{{ $message->subject ?: 'Tanpa subjek' }}</p>

                        <details class="group mt-2">
                            <summary class="cursor-pointer list-none text-sm leading-relaxed text-on-surface-variant">
                                <span class="line-clamp-2 group-open:hidden">{{ $message->message }}</span>
                                <span class="hidden whitespace-pre-line group-open:block">{{ $message->message }}</span>
                            </summary>
                            <span class="mt-1 inline-block font-mono text-[10px] text-orange-600 dark:text-orange-300">Tampilkan lebih sedikit</span>
                        </details>
                    </div>

                    <div class="flex shrink-0 items-center gap-1.5 sm:flex-col">
                        <a
                            href="mailto:{{ $message->email }}?subject={{ rawurlencode('Re: '.($message->subject ?: 'Pesan dari portofolio')) }}"
                            class="flex size-8 items-center justify-center rounded-lg border border-surface-highest text-on-surface-variant transition-colors hover:border-orange-500/40 hover:text-orange-600 dark:hover:text-orange-300"
                            title="Balas via email"
                        >
                            <x-icon name="send" class="size-4" />
                        </a>
                        <form method="POST" action="{{ route('admin.messages.toggle-read', $message) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="flex size-8 cursor-pointer items-center justify-center rounded-lg border border-surface-highest text-on-surface-variant transition-colors hover:bg-surface-high hover:text-heading" title="{{ $message->is_read ? 'Tandai belum dibaca' : 'Tandai sudah dibaca' }}">
                                <x-icon :name="$message->is_read ? 'eye' : 'check-circle'" class="size-4" />
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" data-confirm="Hapus pesan ini?">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex size-8 cursor-pointer items-center justify-center rounded-lg border border-surface-highest text-on-surface-variant transition-colors hover:bg-red-500/10 hover:text-red-500" title="Hapus pesan">
                                <x-icon name="trash" class="size-4" />
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-lg border border-surface-highest bg-surface-low py-20 text-center">
                <div class="mx-auto mb-3 flex size-14 items-center justify-center rounded-lg border border-surface-highest bg-surface-high text-orange-500">
                    <x-icon name="message-square" class="size-7" />
                </div>
                <p class="text-base font-semibold text-heading">Belum ada pesan masuk.</p>
                <p class="mt-1 text-xs text-on-surface-variant">Pesan dari formulir kontak akan muncul di sini.</p>
            </div>
        @endforelse
    </div>
@endsection
