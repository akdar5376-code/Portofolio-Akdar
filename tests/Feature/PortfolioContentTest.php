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

beforeEach(function (): void {
    Profile::factory()->create();
});

it('menampilkan seluruh halaman publik', function (string $route): void {
    $this->get(route($route))->assertOk();
})->with([
    'home',
    'about',
    'skills',
    'projects.index',
    'certificates',
    'experience',
    'cv',
    'contact',
]);

it('menampilkan detail proyek lengkap', function (): void {
    $project = Project::factory()->create([
        'title' => 'Smart Green House',
        'category' => ProjectCategory::IoT,
        'problem' => 'Penyiraman tanaman masih manual.',
        'goal' => 'Mengotomatiskan penyiraman.',
        'tech_stack' => 'ESP32, Laravel, MQTT',
        'role' => 'IoT Developer',
        'features' => "Monitoring sensor\nPenyiraman otomatis",
        'process' => "Riset sensor\nMembangun prototipe",
        'user_feedback' => 'Tanaman tetap terawat saat libur.',
    ]);

    $this->get(route('projects.show', $project))
        ->assertOk()
        ->assertSee('Smart Green House')
        ->assertSee('Penyiraman tanaman masih manual.')
        ->assertSee('Mengotomatiskan penyiraman.')
        ->assertSee('ESP32')
        ->assertSee('Monitoring sensor')
        ->assertSee('Riset sensor')
        ->assertSee('Tanaman tetap terawat saat libur.');
});

it('menampilkan data keahlian dengan persentase', function (): void {
    Skill::factory()->ofType(SkillType::Hard)->create(['name' => 'Laravel', 'percentage' => 90]);

    $this->get(route('skills'))
        ->assertOk()
        ->assertSee('Laravel')
        ->assertSee('90%');
});

it('menampilkan pendidikan dan pengalaman pada halaman tentang', function (): void {
    Education::factory()->create(['institution' => 'SMKN 2 Banjarmasin']);
    Experience::factory()->ofType(ExperienceType::Plk)->create(['title' => 'PLK Web Developer']);

    $this->get(route('about'))
        ->assertOk()
        ->assertSee('SMKN 2 Banjarmasin')
        ->assertSee('PLK Web Developer');
});

it('menampilkan sertifikat dan dokumentasi', function (): void {
    Certificate::factory()->create(['title' => 'Sertifikat Junior Web Developer']);

    $this->get(route('certificates'))
        ->assertOk()
        ->assertSee('Sertifikat Junior Web Developer')
        ->assertSee('Dokumentasi Sertifikat');
});

it('menyimpan pesan dari formulir kesan dan pesan', function (): void {
    $this->post(route('messages.store'), [
        'name' => 'Pengunjung',
        'email' => 'pengunjung@example.com',
        'subject' => 'Kolaborasi',
        'message' => 'Saya tertarik untuk berkolaborasi pada proyek web.',
    ])->assertRedirect()->assertSessionHas('status');

    $message = Message::query()->first();

    expect($message)->not->toBeNull()
        ->and($message->name)->toBe('Pengunjung')
        ->and($message->is_read)->toBeFalse();
});

it('menolak pesan tanpa data wajib', function (): void {
    $this->post(route('messages.store'), [])
        ->assertSessionHasErrors(['name', 'email', 'message']);

    expect(Message::query()->count())->toBe(0);
});

it('menampilkan fitur interaktif pada halaman publik', function (): void {
    $project = Project::factory()->create();

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('data-theme-toggle', false)
        ->assertSee('data-project-preview', false)
        ->assertSee('data-back-to-top', false)
        ->assertSee(route('projects.show', $project), false);
});
