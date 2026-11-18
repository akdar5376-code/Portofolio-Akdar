@extends('layouts.admin-app')

@section('title', 'Pesan Testimoni')
@section('heading', 'Pesan Testimoni')

@section('content')
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div>
            <h2 class="text-2xl font-extrabold tracking-tight text-heading">Pesan Testimoni Masuk</h2>
            <p class="mt-1 text-sm text-on-surface-variant">Lihat pesan yang dikirim pengunjung, sembunyikan, atau hapus bila tidak sesuai.</p>
        </div>
        <span class="rounded-full border border-surface-highest bg-surface-container px-3 py-1.5 font-mono text-[11px] text-on-surface-variant">{{ $testimonies->count() }} dari {{ $total }} testimoni</span>
    </div>

    <div class="mb-5 flex flex-wrap items-center gap-2">
        <a
            href="{{ route('admin.testimonies.index') }}"
            @class([
                'rounded-full border px-4 py-2 text-xs font-semibold transition-colors',
                'border-orange-500/40 bg-orange-600 text-white shadow-md shadow-orange-600/20' => $activeRole === null,
                'border-surface-highest bg-surface-low text-on-surface-variant hover:text-heading' => $activeRole !== null,
            ])
        >Semua</a>
        @foreach ($roles as $role)
            <a
                href="{{ route('admin.testimonies.index', ['role' => $role->value]) }}"
                @class([
                    'rounded-full border px-4 py-2 text-xs font-semibold transition-colors',
                    'border-orange-500/40 bg-orange-600 text-white shadow-md shadow-orange-600/20' => $activeRole === $role,
                    'border-surface-highest bg-surface-low text-on-surface-variant hover:text-heading' => $activeRole !== $role,
                ])
            >{{ $role->label() }}</a>
        @endforeach
    </div>

    <div class="overflow-hidden rounded-lg border border-surface-highest bg-surface-low shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] border-collapse text-left text-sm">
                <thead>
                    <tr class="border-b border-surface-highest bg-surface-container/60 font-mono text-[10px] uppercase tracking-widest text-outline">
                        <th class="w-12 px-4 py-3.5 text-center font-semibold">No</th>
                        <th class="w-44 px-4 py-3.5 font-semibold">Nama</th>
                        <th class="w-36 px-4 py-3.5 font-semibold">Kategori</th>
                        <th class="px-4 py-3.5 font-semibold">Pesan</th>
                        <th class="w-28 px-4 py-3.5 font-semibold">Tanggal</th>
                        <th class="w-24 px-4 py-3.5 text-center font-semibold">Status</th>
                        <th class="w-28 px-4 py-3.5 text-center font-semibold">Aksi</th>
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
                                    <span class="flex size-8 shrink-0 items-center justify-center border border-orange-700/30 bg-orange-700/10 font-mono text-[10px] font-bold text-orange-900 dark:text-orange-300">{{ $testimony->initials }}</span>
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
                            <td class="px-4 py-4 text-center">
                                @if ($testimony->is_visible)
                                    <span class="inline-flex items-center gap-1 rounded-full border border-emerald-500/30 bg-emerald-500/10 px-2 py-0.5 font-mono text-[10px] font-bold text-emerald-600 dark:text-emerald-300">Tampil</span>
                                @else
                                    <span class="inline-flex items-center gap-1 rounded-full border border-surface-highest bg-surface-container px-2 py-0.5 font-mono text-[10px] font-bold text-outline">Disembunyikan</span>
                                @endif
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center justify-center gap-1">
                                    <form method="POST" action="{{ route('admin.testimonies.toggle-visibility', $testimony) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="flex size-7 cursor-pointer items-center justify-center rounded-lg text-on-surface-variant transition-colors hover:bg-surface-high hover:text-heading" title="{{ $testimony->is_visible ? 'Sembunyikan' : 'Tampilkan' }}">
                                            <x-icon name="eye" class="size-3.5" />
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.testimonies.destroy', $testimony) }}" data-confirm="Hapus testimoni ini?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex size-7 cursor-pointer items-center justify-center rounded-lg text-on-surface-variant transition-colors hover:bg-red-500/10 hover:text-red-500" title="Hapus">
                                            <x-icon name="trash" class="size-3.5" />
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-14 text-center">
                                <div class="mx-auto mb-3 flex size-14 items-center justify-center rounded-lg border border-surface-highest bg-surface-high text-orange-500">
                                    <x-icon name="quote" class="size-7" />
                                </div>
                                <p class="text-sm font-semibold text-heading">Belum ada testimoni masuk.</p>
                                <p class="mt-1 text-xs text-on-surface-variant">Testimoni dari pengunjung akan muncul di sini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
