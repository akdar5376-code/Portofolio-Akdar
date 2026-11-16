<?php

use App\Enums\PostCategory;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function (): void {
    Storage::fake('public');
    $this->admin = User::factory()->create(['is_admin' => true]);
    $this->user = User::factory()->create(['is_admin' => false]);
});

it('menghalangi tamu membuka kelola blog', function (): void {
    $this->get(route('admin.posts.index'))->assertRedirect(route('admin.login'));
});

it('menghalangi pengguna non admin membuka kelola blog', function (): void {
    $this->actingAs($this->user)
        ->get(route('admin.posts.index'))
        ->assertForbidden();
});

it('menampilkan ringkasan statistik artikel', function (): void {
    Post::factory()->count(2)->create();
    Post::factory()->draft()->create();

    $this->actingAs($this->admin)
        ->get(route('admin.posts.index'))
        ->assertOk()
        ->assertSee('Total Artikel')
        ->assertSee('3');
});

it('menyimpan artikel baru sebagai draf', function (): void {
    $this->actingAs($this->admin)
        ->post(route('admin.posts.store'), [
            'title' => 'Catatan Rilis Laravel',
            'category' => PostCategory::Catatan->value,
            'excerpt' => 'Ringkasan catatan rilis.',
            'body' => '# Pembuka\n\nIsi catatan.',
            'is_published' => '0',
        ])
        ->assertRedirect()
        ->assertSessionHas('status');

    $post = Post::query()->firstWhere('title', 'Catatan Rilis Laravel');

    expect($post)->not->toBeNull()
        ->and($post->slug)->toBe('catatan-rilis-laravel')
        ->and($post->is_published)->toBeFalse()
        ->and($post->published_at)->toBeNull();
});

it('menerbitkan artikel dan mengisi tanggal terbit otomatis', function (): void {
    $this->actingAs($this->admin)
        ->post(route('admin.posts.store'), [
            'title' => 'Artikel Langsung Terbit',
            'category' => PostCategory::Artikel->value,
            'body' => 'Isi artikel.',
            'is_published' => '1',
        ])
        ->assertRedirect();

    $post = Post::query()->firstWhere('title', 'Artikel Langsung Terbit');

    expect($post->is_published)->toBeTrue()
        ->and($post->published_at)->not->toBeNull()
        ->and($post->isVisible())->toBeTrue();
});

it('menyimpan artikel terjadwal untuk masa depan', function (): void {
    $this->actingAs($this->admin)
        ->post(route('admin.posts.store'), [
            'title' => 'Artikel Terjadwal Besok',
            'category' => PostCategory::Artikel->value,
            'body' => 'Isi artikel.',
            'is_published' => '1',
            'published_at' => now()->addDay()->format('Y-m-d\TH:i'),
        ])
        ->assertRedirect();

    $post = Post::query()->firstWhere('title', 'Artikel Terjadwal Besok');

    expect($post->is_published)->toBeTrue()
        ->and($post->isVisible())->toBeFalse();
});

it('menyimpan artikel dengan cover yang diunggah', function (): void {
    $this->actingAs($this->admin)
        ->post(route('admin.posts.store'), [
            'title' => 'Artikel Bercover',
            'category' => PostCategory::Tutorial->value,
            'body' => 'Isi artikel.',
            'cover' => UploadedFile::fake()->image('cover.png', 1200, 675),
        ])
        ->assertRedirect();

    $post = Post::query()->firstWhere('title', 'Artikel Bercover');

    expect($post->cover_path)->not->toBeNull();
    Storage::disk('public')->assertExists($post->cover_path);
});

it('menolak artikel tanpa judul dan isi', function (): void {
    $this->actingAs($this->admin)
        ->post(route('admin.posts.store'), [
            'title' => '',
            'body' => '',
        ])
        ->assertSessionHasErrors(['title', 'body']);

    expect(Post::query()->count())->toBe(0);
});

it('menolak cover yang bukan gambar', function (): void {
    $this->actingAs($this->admin)
        ->post(route('admin.posts.store'), [
            'title' => 'Artikel Cover Tidak Valid',
            'body' => 'Isi artikel.',
            'cover' => UploadedFile::fake()->create('dokumen.pdf', 100, 'application/pdf'),
        ])
        ->assertSessionHasErrors('cover');

    expect(Post::query()->count())->toBe(0);
});

it('memuat artikel terpilih ke form edit', function (): void {
    $post = Post::factory()->create(['title' => 'Artikel Untuk Diedit']);

    $this->actingAs($this->admin)
        ->get(route('admin.posts.index', ['edit' => $post->id]))
        ->assertOk()
        ->assertSee('Edit Artikel')
        ->assertSee('Artikel Untuk Diedit');
});

it('memperbarui data artikel', function (): void {
    $post = Post::factory()->create();

    $this->actingAs($this->admin)
        ->put(route('admin.posts.update', $post), [
            'title' => 'Judul Artikel Baru',
            'body' => 'Isi yang diperbarui.',
            'is_published' => '1',
        ])
        ->assertRedirect();

    expect($post->refresh())
        ->title->toBe('Judul Artikel Baru')
        ->slug->toBe('judul-artikel-baru')
        ->body->toBe('Isi yang diperbarui.');
});

it('mengganti cover artikel dengan file baru', function (): void {
    Storage::disk('public')->put('posts/lama.jpg', 'gambar-lama');
    $post = Post::factory()->create(['cover_path' => 'posts/lama.jpg']);

    $this->actingAs($this->admin)
        ->put(route('admin.posts.update', $post), [
            'title' => $post->title,
            'body' => $post->body,
            'cover' => UploadedFile::fake()->image('baru.jpg', 1200, 675),
        ])
        ->assertRedirect();

    $post->refresh();

    expect($post->cover_path)->not->toBe('posts/lama.jpg');
    Storage::disk('public')->assertExists($post->cover_path);
    Storage::disk('public')->assertMissing('posts/lama.jpg');
});

it('menghapus cover artikel saat dicentang', function (): void {
    Storage::disk('public')->put('posts/lama.jpg', 'gambar-lama');
    $post = Post::factory()->create(['cover_path' => 'posts/lama.jpg']);

    $this->actingAs($this->admin)
        ->put(route('admin.posts.update', $post), [
            'title' => $post->title,
            'body' => $post->body,
            'remove_cover' => '1',
        ])
        ->assertRedirect();

    expect($post->refresh()->cover_path)->toBeNull();
    Storage::disk('public')->assertMissing('posts/lama.jpg');
});

it('menghapus artikel beserta covernya', function (): void {
    Storage::disk('public')->put('posts/cover.jpg', 'gambar');
    $post = Post::factory()->create(['cover_path' => 'posts/cover.jpg']);

    $this->actingAs($this->admin)
        ->delete(route('admin.posts.destroy', $post))
        ->assertRedirect();

    $this->assertModelMissing($post);
    Storage::disk('public')->assertMissing('posts/cover.jpg');
});

it('menolak pengguna non admin saat menyimpan artikel', function (): void {
    $this->actingAs($this->user)
        ->post(route('admin.posts.store'), [
            'title' => 'Artikel Ilegal',
            'body' => 'Tidak boleh tersimpan.',
        ])
        ->assertForbidden();

    expect(Post::query()->count())->toBe(0);
});
