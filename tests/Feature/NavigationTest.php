<?php

use Illuminate\Support\Str;

it('menampilkan menu header sesuai urutan halaman utama', function (): void {
    $response = $this->get(route('home'))->assertOk();

    $header = Str::between($response->getContent(), 'data-purpose="site-navigation-header"', '</header>');

    $labels = [
        'Beranda',
        'Tentang',
        'Keahlian',
        'Proyek',
        'Sertifikat',
        'Blog',
        'Testimoni',
        'Hubungi Saya',
    ];

    $positions = array_map(fn (string $label): int|false => strpos($header, $label), $labels);

    expect($positions)->not->toContain(false)
        ->and($positions)->toBe(collect($positions)->sort()->values()->all());
});

it('menghubungkan menu Blog dan Hubungi Saya ke halaman yang benar', function (): void {
    $response = $this->get(route('home'))->assertOk();

    $header = Str::between($response->getContent(), 'data-purpose="site-navigation-header"', '</header>');

    expect($header)
        ->toContain(route('posts.index'))
        ->toContain(route('contact'));
});

it('menampilkan judul Hubungi Saya di halaman kontak', function (): void {
    $this->get(route('contact'))
        ->assertOk()
        ->assertSee('Hubungi Saya')
        ->assertDontSee('Kontak |');
});
