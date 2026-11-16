<?php

use App\Enums\ProjectCategory;
use App\Models\Project;

it('menampilkan seluruh proyek di galeri publik', function (): void {
    Project::factory()->ofCategory(ProjectCategory::Web)->create(['title' => 'Web Sekolah']);
    Project::factory()->ofCategory(ProjectCategory::IoT)->create(['title' => 'Smart Home']);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Web Sekolah')
        ->assertSee('Smart Home')
        ->assertSee('Muhammad Akdar');
});

it('hanya menampilkan proyek sesuai filter kategori', function (): void {
    Project::factory()->ofCategory(ProjectCategory::Web)->create(['title' => 'Web Sekolah']);
    Project::factory()->ofCategory(ProjectCategory::Mobile)->create(['title' => 'SiPitung']);

    $this->get(route('home', ['category' => 'Mobile']))
        ->assertOk()
        ->assertSee('SiPitung')
        ->assertDontSee('Web Sekolah');
});

it('menampilkan empty state saat kategori tidak memiliki proyek', function (): void {
    Project::factory()->ofCategory(ProjectCategory::Web)->create();

    $this->get(route('home', ['category' => 'IoT']))
        ->assertOk()
        ->assertSee('Tidak ada proyek yang sesuai kategori ini.');
});

it('menampilkan semua proyek saat kategori tidak valid', function (): void {
    Project::factory()->ofCategory(ProjectCategory::Web)->create(['title' => 'Web Sekolah']);

    $this->get(route('home', ['category' => 'Tidak-Valid']))
        ->assertOk()
        ->assertSee('Web Sekolah');
});

it('membuat tautan ke halaman login admin di header', function (): void {
    $this->get(route('home'))
        ->assertSee(route('admin.login'), false);
});

it('membentuk slug dari judul proyek secara otomatis', function (): void {
    $project = Project::factory()->create(['title' => 'Sistem Informasi Akademik Siswa']);

    expect($project->slug)->toBe('sistem-informasi-akademik-siswa');
});

it('menampilkan tautan demo hanya bila url proyek diisi', function (): void {
    Project::factory()->create(['title' => 'Tanpa Demo', 'project_url' => null]);
    Project::factory()->create(['title' => 'Dengan Demo', 'project_url' => 'https://github.com/akdar/demo']);

    $response = $this->get(route('home'))->assertOk();

    expect(substr_count($response->getContent(), 'https://github.com/akdar/demo'))->toBeGreaterThan(0);
});
