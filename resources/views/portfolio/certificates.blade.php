@extends('layouts.app')

@section('title', 'Sertifikat & Prestasi | '.$profile->full_name)
@section('description', 'Sertifikat, penghargaan, dan dokumentasi prestasi '.$profile->full_name.'.')

@section('content')
    <x-page-header
        badge="Pencapaian"
        title="Sertifikat & Prestasi"
        description="Kumpulan sertifikat kompetensi, penyelesaian kelas, dan penghargaan yang saya peroleh."
    />

    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        @if ($certificates->isEmpty())
            <div class="rounded-3xl border border-surface-highest bg-surface-low py-20 text-center">
                <div class="mx-auto mb-4 flex size-16 items-center justify-center rounded-lg border border-surface-highest bg-surface-high text-orange-500">
                    <x-icon name="award" class="size-8" />
                </div>
                <p class="text-base font-semibold text-heading">Belum ada sertifikat yang ditampilkan.</p>
                <p class="mt-1 text-xs text-on-surface-variant">Sertifikat akan muncul setelah ditambahkan dari panel admin.</p>
            </div>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($certificates as $certificate)
                    <x-certificate-card :certificate="$certificate" />
                @endforeach
            </div>
        @endif
    </section>
@endsection
