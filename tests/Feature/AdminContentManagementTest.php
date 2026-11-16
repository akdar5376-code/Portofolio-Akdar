<?php

use App\Enums\ExperienceType;
use App\Enums\ProjectCategory;
use App\Enums\SkillType;
use App\Models\Certificate;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Message;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function (): void {
    Storage::fake('public');
    $this->admin = User::factory()->create(['is_admin' => true]);
});

it('menampilkan seluruh halaman admin untuk admin', function (string $route): void {
    $this->actingAs($this->admin)
        ->get(route($route))
        ->assertOk();
})->with([
    'admin.dashboard',
    'admin.projects.index',
    'admin.certificates.index',
    'admin.testimonies.index',
    'admin.content.index',
    'admin.messages.index',
    'admin.profile.edit',
]);

it('menghalangi tamu membuka halaman admin baru', function (string $route): void {
    $this->get(route($route))->assertRedirect(route('admin.login'));
})->with([
    'admin.dashboard',
    'admin.certificates.index',
    'admin.testimonies.index',
    'admin.content.index',
    'admin.messages.index',
    'admin.profile.edit',
]);

it('membuat dan menghapus keahlian', function (): void {
    $this->actingAs($this->admin)
        ->post(route('admin.skills.store'), [
            'name' => 'Laravel',
            'type' => SkillType::Hard->value,
            'percentage' => 90,
            'icon' => 'terminal',
        ])
        ->assertRedirect()
        ->assertSessionHas('status');

    $skill = Skill::query()->firstWhere('name', 'Laravel');

    expect($skill)->not->toBeNull()
        ->and($skill->type)->toBe(SkillType::Hard)
        ->and($skill->percentage)->toBe(90);

    $this->actingAs($this->admin)
        ->delete(route('admin.skills.destroy', $skill))
        ->assertRedirect();

    $this->assertModelMissing($skill);
});

it('memperbarui keahlian', function (): void {
    $skill = Skill::factory()->create(['name' => 'PHP', 'percentage' => 70]);

    $this->actingAs($this->admin)
        ->put(route('admin.skills.update', $skill), [
            'name' => 'PHP Lanjutan',
            'type' => SkillType::Hard->value,
            'percentage' => 88,
            'icon' => 'code',
        ])
        ->assertRedirect();

    expect($skill->refresh())
        ->name->toBe('PHP Lanjutan')
        ->percentage->toBe(88);
});

it('membuat pengalaman dan pendidikan', function (): void {
    $this->actingAs($this->admin)
        ->post(route('admin.experiences.store'), [
            'title' => 'PKL Web Developer',
            'organization' => 'CV Digital Nusantara',
            'type' => ExperienceType::Plk->value,
            'period' => 'Juli - September 2026',
            'description' => 'Membangun dashboard admin.',
        ])
        ->assertRedirect();

    $this->actingAs($this->admin)
        ->post(route('admin.educations.store'), [
            'institution' => 'SMKN 2 Banjarmasin',
            'level' => 'SMK',
            'period' => '2024 - 2027',
            'description' => 'Kompetensi RPL.',
        ])
        ->assertRedirect();

    expect(Experience::query()->firstWhere('title', 'PKL Web Developer'))->not->toBeNull()
        ->and(Education::query()->firstWhere('institution', 'SMKN 2 Banjarmasin'))->not->toBeNull();
});

it('mengunggah dan menghapus sertifikat beserta gambar', function (): void {
    $this->actingAs($this->admin)
        ->post(route('admin.certificates.store'), [
            'title' => 'Sertifikat Kompetensi',
            'issuer' => 'BNSP',
            'year' => '2026',
            'description' => 'Sertifikasi kompetensi web.',
            'image' => UploadedFile::fake()->image('sertifikat.png', 800, 600),
        ])
        ->assertRedirect();

    $certificate = Certificate::query()->firstWhere('title', 'Sertifikat Kompetensi');

    expect($certificate)->not->toBeNull()
        ->and($certificate->image_path)->not->toBeNull();

    Storage::disk('public')->assertExists($certificate->image_path);

    $this->actingAs($this->admin)
        ->delete(route('admin.certificates.destroy', $certificate))
        ->assertRedirect();

    $this->assertModelMissing($certificate);
    Storage::disk('public')->assertMissing($certificate->image_path);
});

it('memperbarui profil dan mengunggah foto', function (): void {
    $this->actingAs($this->admin)
        ->put(route('admin.profile.update'), [
            'full_name' => 'Muhammad Akdar',
            'role' => 'Full Stack Developer',
            'class_name' => 'XII RPL 1',
            'competency' => 'Rekayasa Perangkat Lunak',
            'email' => 'akdar@example.com',
            'bio' => 'Siswa yang fokus pada pengembangan web.',
            'avatar' => UploadedFile::fake()->image('avatar.png', 400, 400),
        ])
        ->assertRedirect();

    $profile = Profile::query()->first();

    expect($profile)->not->toBeNull()
        ->and($profile->role)->toBe('Full Stack Developer')
        ->and($profile->avatar_path)->not->toBeNull();

    Storage::disk('public')->assertExists($profile->avatar_path);
});

it('menandai pesan sebagai dibaca dan menghapusnya', function (): void {
    $message = Message::factory()->create(['is_read' => false]);

    $this->actingAs($this->admin)
        ->patch(route('admin.messages.toggle-read', $message))
        ->assertRedirect();

    expect($message->refresh()->is_read)->toBeTrue();

    $this->actingAs($this->admin)
        ->delete(route('admin.messages.destroy', $message))
        ->assertRedirect();

    $this->assertModelMissing($message);
});

it('menyimpan proyek dengan detail lengkap', function (): void {
    $this->actingAs($this->admin)
        ->post(route('admin.projects.store'), [
            'title' => 'Aplikasi Kasir Sekolah',
            'category' => ProjectCategory::Web->value,
            'description' => 'Aplikasi kasir untuk kantin sekolah.',
            'detail' => 'Aplikasi kasir berbasis web.',
            'problem' => 'Pencatatan transaksi masih manual.',
            'goal' => 'Mempercepat proses transaksi.',
            'tech_stack' => 'Laravel, Tailwind CSS, MySQL',
            'role' => 'Full Stack Developer',
            'features' => "Kelola produk\nLaporan penjualan",
            'process' => "Analisis kebutuhan\nImplementasi",
            'user_feedback' => 'Transaksi menjadi lebih cepat.',
            'project_url' => 'https://demo.example.com',
            'github_url' => 'https://github.com/example/kasir',
            'is_featured' => '1',
        ])
        ->assertRedirect();

    $project = Project::query()->firstWhere('title', 'Aplikasi Kasir Sekolah');

    expect($project)->not->toBeNull()
        ->and($project->is_featured)->toBeTrue()
        ->and($project->tech_stack_list)->toBe(['Laravel', 'Tailwind CSS', 'MySQL'])
        ->and($project->feature_list)->toBe(['Kelola produk', 'Laporan penjualan'])
        ->and($project->process_steps)->toBe(['Analisis kebutuhan', 'Implementasi']);
});
