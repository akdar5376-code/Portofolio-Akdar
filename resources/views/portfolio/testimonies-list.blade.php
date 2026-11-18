@extends('layouts.app')

@section('title', 'Testimoni | '.$profile->full_name)
@section('description', 'Baca kesan dan penilaian dari siswa, guru, pengguna, serta tempat magang tentang '.$profile->full_name.'.')

@section('content')
    <section class="mx-auto max-w-7xl border-t border-surface-highest/50 px-4 py-16 sm:px-6 sm:py-20 lg:px-8">
        <div class="mb-10 flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
            <div class="max-w-2xl">
                <span class="mb-3 inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-widest text-orange-800 dark:text-orange-300">
                    <span class="h-px w-6 bg-orange-700"></span>
                    Testimoni
                </span>
                <h1 class="text-3xl font-extrabold tracking-tight text-heading sm:text-4xl">Kata mereka tentang saya</h1>
                <p class="mt-3 text-sm leading-relaxed text-on-surface-variant sm:text-base">Penilaian dari guru pembimbing, teman, pengguna produk, dan pembimbing di tempat PLK.</p>
            </div>
            <a href="{{ route('testimonies.create') }}" class="inline-flex shrink-0 items-center justify-center gap-2 rounded-lg border border-surface-highest bg-surface-low px-4 py-3 text-sm font-semibold text-on-surface transition-colors hover:border-orange-700 hover:text-orange-800 dark:hover:text-orange-300">
                Kirim Testimoni
                <x-icon name="send" class="size-4" />
            </a>
        </div>

        @if ($testimonies->isEmpty())
            <p class="rounded-2xl border border-surface-highest bg-surface-low p-8 text-center text-sm text-on-surface-variant">Belum ada testimoni.</p>
        @else
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($testimonies as $testimony)
                    <x-testimony-card :testimony="$testimony" />
                @endforeach
            </div>
        @endif
    </section>
@endsection
