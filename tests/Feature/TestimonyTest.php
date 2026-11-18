<?php

use App\Enums\TestimonyRole;
use App\Models\Testimony;
use App\Models\User;

beforeEach(function (): void {
    $this->admin = User::factory()->create(['is_admin' => true]);
});

it('menampilkan tabel testimoni dengan empat kategori', function (): void {
    Testimony::factory()->guru()->create(['name' => 'Ibu Siti Rahmawati', 'message' => 'Siswa yang disiplin.']);
    Testimony::factory()->siswa()->create(['name' => 'Rizky Pratama', 'message' => 'Senang bekerja sama.']);
    Testimony::factory()->pengguna()->create(['name' => 'Bapak Hendra', 'message' => 'Aplikasinya membantu.']);
    Testimony::factory()->tempatMagang()->create(['name' => 'Ibu Dewi Lestari', 'message' => 'Etos kerja tinggi.']);

    $this->get(route('testimonies'))
        ->assertOk()
        ->assertSee('Siswa')
        ->assertSee('Guru')
        ->assertSee('Pengguna')
        ->assertSee('Tempat Magang')
        ->assertSee('Ibu Siti Rahmawati')
        ->assertSee('Rizky Pratama')
        ->assertSee('Bapak Hendra')
        ->assertSee('Ibu Dewi Lestari');
});

it('menyembunyikan testimoni yang tidak ditampilkan', function (): void {
    Testimony::factory()->guru()->create(['name' => 'Testimoni Tersembunyi', 'is_visible' => false]);

    $this->get(route('testimonies'))
        ->assertOk()
        ->assertDontSee('Testimoni Tersembunyi');
});

it('mengirim testimoni baru dari halaman publik', function (): void {
    $this->post(route('testimonies.store'), [
        'name' => 'Pengunjung Baru',
        'role' => TestimonyRole::Pengguna->value,
        'message' => 'Aplikasinya sangat membantu pekerjaan saya.',
    ])
        ->assertRedirect()
        ->assertSessionHas('status');

    $testimony = Testimony::query()->firstWhere('name', 'Pengunjung Baru');

    expect($testimony)->not->toBeNull()
        ->and($testimony->role)->toBe(TestimonyRole::Pengguna)
        ->and($testimony->is_visible)->toBeTrue();
});

it('memvalidasi isian testimoni', function (): void {
    $this->post(route('testimonies.store'), [])
        ->assertSessionHasErrors(['name', 'role', 'message']);
});

it('menampilkan daftar testimoni di halaman testimoni', function (): void {
    Testimony::factory()->guru()->create(['name' => 'Pak Budi Santoso', 'message' => 'Kerja bagus.']);

    $this->get(route('testimonies'))
        ->assertOk()
        ->assertSee('Kata mereka tentang saya')
        ->assertSee('Pak Budi Santoso');
});

it('menyembunyikan dan menghapus testimoni dari panel admin', function (): void {
    $testimony = Testimony::factory()->guru()->create(['name' => 'Ibu Dewi']);

    $this->actingAs($this->admin)
        ->patch(route('admin.testimonies.toggle-visibility', $testimony))
        ->assertRedirect();

    expect($testimony->refresh()->is_visible)->toBeFalse();

    $this->actingAs($this->admin)
        ->delete(route('admin.testimonies.destroy', $testimony))
        ->assertRedirect();

    $this->assertModelMissing($testimony);
});

it('menghalangi tamu membuka kelola testimoni', function (): void {
    $this->get(route('admin.testimonies.index'))->assertRedirect(route('admin.login'));
});
