<?php

namespace Database\Seeders;

use App\Enums\TestimonyRole;
use App\Models\Testimony;
use Illuminate\Database\Seeder;

class TestimonySeeder extends Seeder
{
    public function run(): void
    {
        $testimonies = [
            [
                'name' => 'Ibu Siti Rahmawati, S.Kom.',
                'role' => TestimonyRole::Guru,
                'message' => 'Akdar merupakan siswa yang disiplin, cepat memahami materi baru, dan aktif bertanya saat praktik. Kemampuannya membangun aplikasi web sudah di atas rata-rata untuk tingkat siswa SMK.',
            ],
            [
                'name' => 'Rizky Pratama',
                'role' => TestimonyRole::Siswa,
                'message' => 'Bekerja bersama Akdar selalu menyenangkan. Ia sering membantu teman yang kesulitan memahami kode dan tidak pernah pelit ilmu. Saat proyek kelompok, idenya selalu solutif.',
            ],
            [
                'name' => 'Bapak Hendra Wijaya',
                'role' => TestimonyRole::Pengguna,
                'message' => 'Aplikasi kasir yang dibuat Akdar sangat membantu pencatatan transaksi harian di kantin. Tampilannya mudah dipahami dan laporan penjualan jadi lebih rapi.',
            ],
            [
                'name' => 'Ibu Dewi Lestari',
                'role' => TestimonyRole::TempatMagang,
                'message' => 'Selama Praktik Kerja Lapangan, Akdar menunjukkan etos kerja yang tinggi dan mudah beradaptasi dengan alur kerja tim. Ia menyelesaikan modul dashboard admin sesuai target.',
            ],
        ];

        foreach ($testimonies as $index => $testimony) {
            Testimony::query()->updateOrCreate(
                ['name' => $testimony['name']],
                [...$testimony, 'is_visible' => true, 'sort_order' => $index],
            );
        }
    }
}
