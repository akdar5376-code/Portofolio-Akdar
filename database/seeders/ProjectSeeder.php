<?php

namespace Database\Seeders;

use App\Enums\ProjectCategory;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@porto.folio'],
            [
                'name' => 'Muhammad Akdar',
                'password' => 'password',
                'is_admin' => true,
            ],
        );

        $projects = [
            [
                'title' => 'Sistem Informasi Akademik Siswa',
                'category' => ProjectCategory::Web,
                'description' => 'Aplikasi manajemen nilai, presensi, dan e-raport berbasis Laravel dan Tailwind CSS.',
                'detail' => 'Sistem Informasi Akademik Siswa adalah platform terpusat untuk mengelola data akademik sekolah. Guru dapat menginput nilai dan presensi, sementara siswa memantau hasil belajar serta mengunduh e-raport secara mandiri.',
                'problem' => 'Pencatatan nilai dan presensi masih dilakukan di banyak berkas spreadsheet terpisah sehingga rawan duplikasi dan memakan waktu saat rekap akhir semester.',
                'goal' => 'Memusatkan data akademik dalam satu sistem, mempercepat proses rekap nilai, dan memberi siswa akses transparan terhadap hasil belajar.',
                'tech_stack' => 'Laravel, Tailwind CSS, MySQL, Alpine.js',
                'role' => 'Full Stack Developer',
                'features' => "Autentikasi multi-role (admin, guru, siswa)\nInput nilai dan presensi\nRekap otomatis dan e-raport\nFilter kelas dan mata pelajaran\nEkspor laporan PDF",
                'project_url' => 'https://demo-siak.example.com',
                'github_url' => 'https://github.com/akdar/siak-sekolah',
                'process' => "Analisis kebutuhan bersama guru\nMerancang ERD dan alur pengguna\nMembangun backend Laravel\nMendesain antarmuka responsif\nPengujian dan pendampingan pengguna",
                'user_feedback' => 'Rekap nilai yang dulu butuh dua hari kini selesai dalam hitungan menit. Tampilannya juga mudah dipahami guru senior.',
                'is_featured' => true,
            ],
            [
                'title' => 'Smart Green House & Irigasi Otomatis',
                'category' => ProjectCategory::IoT,
                'description' => 'Sensor kelembapan tanah terhubung ESP32 dan dashboard telemetri real-time.',
                'detail' => 'Proyek IoT yang memantau kondisi tanah dan udara pada greenhouse sekolah. Data sensor dikirim ke dashboard sehingga penyiraman dapat dilakukan otomatis maupun manual dari jarak jauh.',
                'problem' => 'Penyiraman tanaman di greenhouse sekolah masih manual dan sering terlambat saat hari libur, menyebabkan tanaman layu.',
                'goal' => 'Mengotomatiskan penyiraman berdasarkan kelembapan tanah dan menyediakan pemantauan jarak jauh.',
                'tech_stack' => 'ESP32, Sensor DHT22, Sensor Soil Moisture, MQTT, Laravel, Chart.js',
                'role' => 'IoT Developer & Hardware Integrator',
                'features' => "Monitoring kelembapan tanah dan suhu\nPenyiraman otomatis berbasis ambang batas\nKontrol manual dari dashboard\nRiwayat data dan grafik\nNotifikasi kondisi kritis",
                'project_url' => null,
                'github_url' => 'https://github.com/akdar/smart-greenhouse',
                'process' => "Riset sensor dan mikrokontroler\nMenyusun rangkaian prototipe\nMembangun firmware ESP32\nMembuat dashboard telemetri\nUji coba lapangan selama dua minggu",
                'user_feedback' => 'Tanaman tetap terawat saat libur sekolah. Dashboard-nya membantu kami melihat kondisi greenhouse tanpa harus datang.',
                'is_featured' => true,
            ],
            [
                'title' => 'Kantin Digital Pay Mobile App',
                'category' => ProjectCategory::Mobile,
                'description' => 'Aplikasi transaksi digital berbasis Flutter dan QRIS untuk kantin sekolah.',
                'detail' => 'Aplikasi mobile untuk mempercepat transaksi di kantin sekolah. Siswa dapat melakukan pembayaran nontunai, melihat riwayat transaksi, dan memantau saldo. Penjual menerima notifikasi pesanan secara langsung.',
                'problem' => 'Antrean kantin saat jam istirahat panjang karena transaksi tunai dan pencatatan manual.',
                'goal' => 'Mempercepat transaksi, mengurangi kesalahan kembalian, dan membantu penjual memantau penjualan harian.',
                'tech_stack' => 'Flutter, Laravel API, MySQL, QRIS',
                'role' => 'Mobile Developer',
                'features' => "Pembayaran nontunai dengan QRIS\nRiwayat dan saldo transaksi\nNotifikasi pesanan untuk penjual\nDashboard penjualan harian\nMode gelap dan terang",
                'project_url' => null,
                'github_url' => 'https://github.com/akdar/kantin-digital',
                'process' => "Wawancara pengelola kantin\nMembuat wireframe aplikasi\nMengembangkan API Laravel\nMembangun aplikasi Flutter\nUji coba dengan siswa dan penjual",
                'user_feedback' => 'Antrean jadi lebih cepat dan siswa tidak perlu membawa uang tunai. Penjual juga lebih mudah melihat rekap harian.',
                'is_featured' => true,
            ],
            [
                'title' => 'Web Sekolah',
                'category' => ProjectCategory::Web,
                'description' => 'Website profil sekolah dengan informasi kegiatan, berita, dan galeri.',
                'detail' => 'Website profil sekolah yang menampilkan informasi program keahlian, berita kegiatan, agenda, dan galeri dokumentasi sekolah.',
                'problem' => 'Informasi sekolah tersebar di media sosial dan sulit ditemukan kembali oleh calon siswa.',
                'goal' => 'Menyediakan pusat informasi resmi sekolah yang mudah diakses dan diperbarui.',
                'tech_stack' => 'PHP, Laravel, Tailwind CSS, MySQL',
                'role' => 'Web Developer',
                'features' => "Halaman profil dan program keahlian\nBerita dan agenda sekolah\nGaleri dokumentasi\nFormulir kontak",
                'project_url' => null,
                'github_url' => 'https://github.com/akdar/web-sekolah',
                'process' => "Mengumpulkan konten dari pihak sekolah\nMenyusun struktur halaman\nImplementasi desain responsif\nPublikasi dan pelatihan admin",
                'user_feedback' => 'Calon siswa sekarang bisa menemukan informasi sekolah dengan mudah dari satu tautan.',
                'is_featured' => false,
            ],
            [
                'title' => 'SiPitung',
                'category' => ProjectCategory::Mobile,
                'description' => 'Aplikasi pencatatan keuangan pribadi dengan laporan bulanan.',
                'detail' => 'SiPitung membantu siswa mencatat pemasukan dan pengeluaran harian, menetapkan anggaran, serta melihat laporan bulanan dalam bentuk grafik yang mudah dipahami.',
                'problem' => 'Banyak siswa kesulitan memantau pengeluaran sehingga uang saku cepat habis tanpa diketahui penyebabnya.',
                'goal' => 'Membantu siswa mengelola keuangan pribadi dengan pencatatan sederhana dan visualisasi yang jelas.',
                'tech_stack' => 'Flutter, SQLite, Provider',
                'role' => 'Mobile Developer',
                'features' => "Pencatatan pemasukan dan pengeluaran\nAnggaran per kategori\nGrafik laporan bulanan\nEkspor data CSV\nKategori kustom",
                'project_url' => null,
                'github_url' => 'https://github.com/akdar/sipitung',
                'process' => "Riset kebutuhan pengguna\nMerancang alur aplikasi\nMembangun UI Flutter\nMengimplementasikan penyimpanan lokal\nPengujian beta",
                'user_feedback' => 'Sekarang saya tahu uang saku habis untuk apa. Grafiknya membantu saya lebih disiplin.',
                'is_featured' => false,
            ],
            [
                'title' => 'Smart Home',
                'category' => ProjectCategory::IoT,
                'description' => 'Prototipe kontrol lampu dan perangkat rumah melalui aplikasi web.',
                'detail' => 'Prototipe smart home sederhana untuk menyalakan dan mematikan lampu serta memantau penggunaan energi melalui aplikasi web.',
                'problem' => 'Lampu sering dibiarkan menyala padahal tidak digunakan sehingga pemborosan energi.',
                'goal' => 'Memberikan kontrol perangkat rumah dari jarak jauh dan mendorong penghematan energi.',
                'tech_stack' => 'ESP8266, Relay Module, MQTT, Laravel',
                'role' => 'IoT Developer',
                'features' => "Kontrol lampu dari web\nPenjadwalan otomatis\nMonitoring status perangkat\nRiwayat penggunaan",
                'project_url' => null,
                'github_url' => 'https://github.com/akdar/smart-home',
                'process' => "Perancangan rangkaian relay\nPemrograman ESP8266\nIntegrasi MQTT broker\nPembuatan dashboard web\nPengujian stabilitas",
                'user_feedback' => 'Praktis untuk mematikan lampu saat lupa. Pengaturan jadwalnya sangat membantu.',
                'is_featured' => false,
            ],
        ];

        foreach ($projects as $index => $project) {
            Project::query()->updateOrCreate(
                ['title' => $project['title']],
                [...$project, 'sort_order' => $index],
            );
        }
    }
}
