<?php

use App\Enums\ProjectCategory;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function (): void {
    Storage::fake('public');
    $this->admin = User::factory()->create(['is_admin' => true]);
    $this->user = User::factory()->create(['is_admin' => false]);
});

it('menghalangi tamu membuka dashboard admin', function (): void {
    $this->get(route('admin.projects.index'))->assertRedirect(route('admin.login'));
});

it('menghalangi pengguna non admin membuka dashboard admin', function (): void {
    $this->actingAs($this->user)
        ->get(route('admin.projects.index'))
        ->assertForbidden();
});

it('menampilkan ringkasan statistik proyek', function (): void {
    Project::factory()->count(2)->ofCategory(ProjectCategory::Web)->create();
    Project::factory()->ofCategory(ProjectCategory::IoT)->create();

    $this->actingAs($this->admin)
        ->get(route('admin.projects.index'))
        ->assertOk()
        ->assertSee('Total Proyek')
        ->assertSee('3');
});

it('menyimpan proyek baru beserta thumbnail yang diunggah', function (): void {
    $this->actingAs($this->admin)
        ->post(route('admin.projects.store'), [
            'title' => 'Kantin Digital Pay',
            'category' => ProjectCategory::Mobile->value,
            'description' => 'Aplikasi transaksi digital berbasis QRIS.',
            'thumbnail' => UploadedFile::fake()->image('kantin.png', 1200, 675),
        ])
        ->assertRedirect()
        ->assertSessionHas('status');

    $project = Project::query()->firstWhere('title', 'Kantin Digital Pay');

    expect($project)->not->toBeNull()
        ->and($project->thumbnail_path)->not->toBeNull();

    Storage::disk('public')->assertExists($project->thumbnail_path);

    $this->assertDatabaseHas('projects', [
        'title' => 'Kantin Digital Pay',
        'category' => ProjectCategory::Mobile->value,
    ]);
});

it('menolak proyek tanpa judul', function (): void {
    $this->actingAs($this->admin)
        ->post(route('admin.projects.store'), [
            'title' => '',
            'category' => ProjectCategory::Web->value,
        ])
        ->assertSessionHasErrors('title');

    expect(Project::query()->count())->toBe(0);
});

it('menolak file thumbnail yang bukan gambar', function (): void {
    $this->actingAs($this->admin)
        ->post(route('admin.projects.store'), [
            'title' => 'Proyek Tanpa Gambar Valid',
            'category' => ProjectCategory::Web->value,
            'thumbnail' => UploadedFile::fake()->create('dokumen.pdf', 100, 'application/pdf'),
        ])
        ->assertSessionHasErrors('thumbnail');

    expect(Project::query()->count())->toBe(0);
});

it('memuat proyek terpilih ke form edit', function (): void {
    $project = Project::factory()->create(['title' => 'Web Sekolah']);

    $this->actingAs($this->admin)
        ->get(route('admin.projects.index', ['edit' => $project->id]))
        ->assertOk()
        ->assertSee('Edit Project')
        ->assertSee('Web Sekolah');
});

it('memperbarui data proyek', function (): void {
    $project = Project::factory()->ofCategory(ProjectCategory::Web)->create();

    $this->actingAs($this->admin)
        ->put(route('admin.projects.update', $project), [
            'title' => 'Web Sekolah Terbarui',
            'description' => 'Deskripsi baru.',
        ])
        ->assertRedirect();

    expect($project->refresh())
        ->title->toBe('Web Sekolah Terbarui')
        ->description->toBe('Deskripsi baru.');
});

it('mengganti thumbnail proyek dengan file baru', function (): void {
    Storage::disk('public')->put('projects/lama.jpg', 'gambar-lama');
    $project = Project::factory()->create(['thumbnail_path' => 'projects/lama.jpg']);

    $this->actingAs($this->admin)
        ->put(route('admin.projects.update', $project), [
            'title' => $project->title,
            'category' => $project->category->value,
            'thumbnail' => UploadedFile::fake()->image('baru.jpg', 1200, 675),
        ])
        ->assertRedirect();

    $project->refresh();

    expect($project->thumbnail_path)->not->toBe('projects/lama.jpg');

    Storage::disk('public')->assertExists($project->thumbnail_path);
    Storage::disk('public')->assertMissing('projects/lama.jpg');
});

it('menghapus thumbnail proyek saat dicentang', function (): void {
    Storage::disk('public')->put('projects/lama.jpg', 'gambar-lama');
    $project = Project::factory()->create(['thumbnail_path' => 'projects/lama.jpg']);

    $this->actingAs($this->admin)
        ->put(route('admin.projects.update', $project), [
            'title' => $project->title,
            'category' => $project->category->value,
            'remove_thumbnail' => '1',
        ])
        ->assertRedirect();

    expect($project->refresh()->thumbnail_path)->toBeNull();
    Storage::disk('public')->assertMissing('projects/lama.jpg');
});

it('menghapus proyek', function (): void {
    $project = Project::factory()->create();

    $this->actingAs($this->admin)
        ->delete(route('admin.projects.destroy', $project))
        ->assertRedirect();

    $this->assertModelMissing($project);
});

it('menolak pengguna non admin saat menambah proyek', function (): void {
    $project = Project::factory()->create();

    $this->actingAs($this->user)
        ->post(route('admin.projects.store'), [
            'title' => 'Proyek Ilegal',
            'category' => ProjectCategory::Web->value,
        ])
        ->assertForbidden();

    expect(Project::query()->count())->toBe(1);
});
