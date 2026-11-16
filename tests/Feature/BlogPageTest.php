<?php

use App\Enums\PostCategory;
use App\Models\Post;

it('menampilkan artikel yang sudah terbit di halaman blog', function (): void {
    Post::factory()->create(['title' => 'Menjaga Controller Tetap Ramping']);
    Post::factory()->create(['title' => 'Deploy Laravel ke VPS']);

    $this->get(route('posts.index'))
        ->assertOk()
        ->assertSee('Menjaga Controller Tetap Ramping')
        ->assertSee('Deploy Laravel ke VPS');
});

it('menyembunyikan draf dari halaman blog', function (): void {
    Post::factory()->draft()->create(['title' => 'Rencana Tulisan Rahasia']);

    $this->get(route('posts.index'))
        ->assertOk()
        ->assertDontSee('Rencana Tulisan Rahasia');
});

it('menyembunyikan artikel yang belum mencapai jadwal terbit', function (): void {
    Post::factory()->create([
        'title' => 'Artikel Terjadwal',
        'published_at' => now()->addDay(),
    ]);

    $this->get(route('posts.index'))
        ->assertOk()
        ->assertDontSee('Artikel Terjadwal');
});

it('hanya menampilkan artikel sesuai filter kategori', function (): void {
    Post::factory()->ofCategory(PostCategory::Artikel)->create(['title' => 'Artikel Pilihan']);
    Post::factory()->ofCategory(PostCategory::Tutorial)->create(['title' => 'Tutorial Lengkap']);

    $this->get(route('posts.index', ['category' => PostCategory::Tutorial->value]))
        ->assertOk()
        ->assertSee('Tutorial Lengkap')
        ->assertDontSee('Artikel Pilihan');
});

it('mencari artikel berdasarkan judul atau tag', function (): void {
    Post::factory()->create(['title' => 'Optimasi Eloquent', 'tags' => 'Laravel, Performa']);
    Post::factory()->create(['title' => 'Belajar Flutter', 'tags' => 'Mobile']);

    $this->get(route('posts.index', ['q' => 'Eloquent']))
        ->assertOk()
        ->assertSee('Optimasi Eloquent')
        ->assertDontSee('Belajar Flutter');

    $this->get(route('posts.index', ['q' => 'Mobile']))
        ->assertOk()
        ->assertSee('Belajar Flutter')
        ->assertDontSee('Optimasi Eloquent');
});

it('menampilkan detail artikel beserta isi markdown', function (): void {
    $post = Post::factory()->create([
        'title' => 'Catatan Markdown',
        'body' => "# Judul Bagian\n\nIsi **penting** dan `inline code`.",
    ]);

    $this->get(route('posts.show', $post))
        ->assertOk()
        ->assertSee('Catatan Markdown')
        ->assertSee('<h1>Judul Bagian</h1>', false)
        ->assertSee('<strong>penting</strong>', false)
        ->assertSee('<code>inline code</code>', false);
});

it('mengembalikan 404 saat membuka draf artikel', function (): void {
    $post = Post::factory()->draft()->create();

    $this->get(route('posts.show', $post))->assertNotFound();
});

it('mengembalikan 404 saat membuka artikel terjadwal', function (): void {
    $post = Post::factory()->create(['published_at' => now()->addDay()]);

    $this->get(route('posts.show', $post))->assertNotFound();
});

it('membentuk slug dari judul secara otomatis', function (): void {
    $post = Post::factory()->create(['title' => 'Cara Cepat Belajar Laravel']);

    expect($post->slug)->toBe('cara-cepat-belajar-laravel');
});

it('menampilkan estimasi waktu baca minimal satu menit', function (): void {
    $post = Post::factory()->create(['body' => 'Kata singkat.']);

    expect($post->reading_minutes)->toBe(1);
});

it('menampilkan tautan blog di navigasi utama', function (): void {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee(route('posts.index'), false);
});
