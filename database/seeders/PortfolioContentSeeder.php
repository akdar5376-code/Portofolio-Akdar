<?php

namespace Database\Seeders;

use App\Enums\ExperienceType;
use App\Enums\SkillType;
use App\Models\Certificate;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class PortfolioContentSeeder extends Seeder
{
    public function run(): void
    {
        $profile = Profile::current();
        $profile->update([
            'instagram_url' => 'https://instagram.com/akdar',
            'linkedin_url' => 'https://linkedin.com/in/akdar',
            'bio' => 'Saya Muhammad Akdar, siswa XII RPL 1 SMKN 2 Banjarmasin yang senang membangun aplikasi web, mobile, dan solusi IoT. Saya percaya teknologi terbaik adalah teknologi yang menyelesaikan masalah nyata di sekitar kita.',
            'career_goal' => 'Menjadi software engineer profesional, terus belajar membangun produk digital yang bermanfaat, dan suatu hari nanti membangun studio teknologi sendiri.',
            'interests' => 'Web Development, Mobile Development, Internet of Things, UI/UX Design, Cloud Computing',
        ]);

        $educations = [
            ['institution' => 'SMKN 2 Banjarmasin', 'level' => 'SMK', 'period' => '2024 - 2027', 'description' => 'Kompetensi Keahlian Rekayasa Perangkat Lunak (RPL). Aktif dalam pembelajaran pemrograman web, mobile, dan basis data.'],
            ['institution' => 'SMP Negeri 5 Banjarmasin', 'level' => 'SMP', 'period' => '2021 - 2024', 'description' => 'Mulai mengenal dasar komputer dan logika pemrograman melalui ekstrakurikuler.'],
            ['institution' => 'SD Negeri 1 Banjarmasin', 'level' => 'SD', 'period' => '2015 - 2021', 'description' => 'Menempuh pendidikan dasar dan mulai tertarik pada teknologi.'],
        ];

        foreach ($educations as $index => $education) {
            Education::query()->updateOrCreate(
                ['institution' => $education['institution']],
                [...$education, 'sort_order' => $index],
            );
        }

        $skills = [
            ['name' => 'HTML & CSS', 'type' => SkillType::Hard, 'percentage' => 90, 'icon' => 'html5,css3'],
            ['name' => 'JavaScript', 'type' => SkillType::Hard, 'percentage' => 82, 'icon' => 'javascript'],
            ['name' => 'PHP & Laravel', 'type' => SkillType::Hard, 'percentage' => 85, 'icon' => 'php,laravel'],
            ['name' => 'Tailwind CSS', 'type' => SkillType::Hard, 'percentage' => 88, 'icon' => 'tailwind'],
            ['name' => 'MySQL', 'type' => SkillType::Hard, 'percentage' => 80, 'icon' => 'mysql'],
            ['name' => 'Flutter', 'type' => SkillType::Hard, 'percentage' => 70, 'icon' => 'flutter'],
            ['name' => 'Git & GitHub', 'type' => SkillType::Hard, 'percentage' => 84, 'icon' => 'git,github'],
            ['name' => 'Komunikasi', 'type' => SkillType::Soft, 'percentage' => 88, 'icon' => 'message-circle'],
            ['name' => 'Kerja Sama Tim', 'type' => SkillType::Soft, 'percentage' => 90, 'icon' => 'users'],
            ['name' => 'Manajemen Waktu', 'type' => SkillType::Soft, 'percentage' => 82, 'icon' => 'clock'],
            ['name' => 'Problem Solving', 'type' => SkillType::Soft, 'percentage' => 86, 'icon' => 'lightbulb'],
            ['name' => 'Kepemimpinan', 'type' => SkillType::Soft, 'percentage' => 78, 'icon' => 'star'],
        ];

        foreach ($skills as $index => $skill) {
            Skill::query()->updateOrCreate(
                ['name' => $skill['name']],
                [...$skill, 'sort_order' => $index],
            );
        }

        $experiences = [
            [
                'title' => 'Praktik Kerja Lapangan - Web Developer',
                'organization' => 'CV Digital Nusantara',
                'type' => ExperienceType::Plk,
                'period' => 'Juli - September 2026',
                'description' => 'Membangun modul dashboard admin, integrasi API, dan memperbaiki tampilan responsif menggunakan Laravel dan Tailwind CSS. Berkolaborasi dengan tim produktif dan mengikuti code review mingguan.',
            ],
            [
                'title' => 'Ketua Divisi Acara',
                'organization' => 'OSIS SMKN 2 Banjarmasin',
                'type' => ExperienceType::Organization,
                'period' => '2025 - 2026',
                'description' => 'Memimpin perencanaan dan pelaksanaan acara sekolah, mengoordinasikan 20+ panitia, serta menyusun timeline dan evaluasi kegiatan.',
            ],
            [
                'title' => 'Anggota Tim Robotik',
                'organization' => 'Ekstrakurikuler Robotik',
                'type' => ExperienceType::Organization,
                'period' => '2024 - 2025',
                'description' => 'Terlibat dalam perakitan dan pemrograman robot line follower serta pengelolaan dokumentasi proyek.',
            ],
            [
                'title' => 'Juara 2 Web Design Competition',
                'organization' => 'Festival Teknologi Pelajar',
                'type' => ExperienceType::Competition,
                'period' => '2026',
                'description' => 'Merancang dan membangun landing page produk edukasi bersama tim beranggotakan tiga orang dalam waktu 48 jam.',
            ],
            [
                'title' => 'Finalis Hackathon Pelajar Kalimantan',
                'organization' => 'Hackathon Pelajar 2025',
                'type' => ExperienceType::Competition,
                'period' => '2025',
                'description' => 'Mengembangkan prototipe aplikasi pengelolaan sampah sekolah dan mempresentasikannya di hadapan juri.',
            ],
        ];

        foreach ($experiences as $index => $experience) {
            Experience::query()->updateOrCreate(
                ['title' => $experience['title']],
                [...$experience, 'sort_order' => $index],
            );
        }

        $certificates = [
            ['title' => 'Sertifikat Kompetensi Junior Web Developer', 'issuer' => 'BNSP', 'year' => '2026', 'description' => 'Sertifikasi kompetensi bidang pengembangan web.'],
            ['title' => 'Juara 2 Web Design Competition', 'issuer' => 'Festival Teknologi Pelajar', 'year' => '2026', 'description' => 'Penghargaan atas karya landing page edukasi.'],
            ['title' => 'Belajar Dasar Pemrograman JavaScript', 'issuer' => 'Dicoding Indonesia', 'year' => '2025', 'description' => 'Menyelesaikan kelas dasar JavaScript dengan predikat sangat baik.'],
            ['title' => 'Finalis Hackathon Pelajar Kalimantan', 'issuer' => 'Hackathon Pelajar', 'year' => '2025', 'description' => 'Finalis dengan proyek aplikasi pengelolaan sampah sekolah.'],
            ['title' => 'Sertifikat Praktik Kerja Lapangan', 'issuer' => 'CV Digital Nusantara', 'year' => '2026', 'description' => 'Menyelesaikan PLK selama tiga bulan sebagai web developer.'],
        ];

        foreach ($certificates as $index => $certificate) {
            Certificate::query()->updateOrCreate(
                ['title' => $certificate['title']],
                [...$certificate, 'sort_order' => $index],
            );
        }
    }
}
