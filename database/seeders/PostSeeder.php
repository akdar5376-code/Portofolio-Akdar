<?php

namespace Database\Seeders;

use App\Enums\PostCategory;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Menjaga Controller Laravel Tetap Ramping',
                'category' => PostCategory::Artikel,
                'excerpt' => 'Controller yang terlalu gemuk sulit diuji dan dirawat. Ini strategi yang saya pakai untuk memecah tanggung jawabnya.',
                'body' => <<<'MARKDOWN'
                Controller adalah tempat pertama yang dibuka saat ada bug, tapi sering juga menjadi tempat pertama yang membuat kode sulit dibaca. Semakin banyak logika bisnis menumpuk di sana, semakin sulit menambah fitur baru tanpa takut merusak yang lain.

                ## Mulai dari Form Request

                Validasi tidak perlu tinggal di controller. Pindahkan ke Form Request agar aturan tetap dekat dengan fitur yang memakainya:

                ```php
                final class StorePostRequest extends FormRequest
                {
                    public function rules(): array
                    {
                        return [
                            'title' => ['required', 'string', 'max:150'],
                            'body' => ['required', 'string', 'max:20000'],
                        ];
                    }
                }
                ```

                ## Pisahkan aksi yang kompleks

                Jika satu method menyentuh lebih dari tiga model atau melakukan beberapa langkah sekaligus, itu tanda logika bisnis perlu dipindah ke service atau action class. Controller cukup memanggil satu method dan mengembalikan respons.

                ## Kesimpulan

                Controller yang ramping membuat alur request terlihat jelas: validasi, satu panggilan aksi, lalu respons. Sisanya adalah pekerjaan untuk kelas yang lebih tepat.
                MARKDOWN,
                'tags' => 'Laravel, PHP, Arsitektur',
                'is_published' => true,
                'published_at' => now()->subDays(6),
            ],
            [
                'title' => 'Catatan: Membasmi N+1 Query dengan Eager Loading',
                'category' => PostCategory::Catatan,
                'excerpt' => 'Satu baris with() bisa memangkas ratusan query. Catatan singkat soal N+1 yang sering muncul tanpa sadar.',
                'body' => <<<'MARKDOWN'
                N+1 query muncul ketika kita memuat daftar data lalu mengakses relasinya satu per satu di dalam loop. Halaman terasa lambat, padahal datanya sedikit.

                ```php
                // Buruk: satu query untuk posts, lalu satu query per post.
                $posts = Post::all();

                foreach ($posts as $post) {
                    echo $post->category;
                }
                ```

                Perbaikannya cukup dengan eager loading:

                ```php
                // Baik: dua query, berapa pun jumlah post-nya.
                $posts = Post::with('comments')->latest()->get();
                ```

                Biasakan mengecek jumlah query dengan Laravel Debugbar atau `DB::listen()` saat mengembangkan. Kebiasaan kecil ini menyelamatkan performa halaman sebelum masalahnya terasa di produksi.
                MARKDOWN,
                'tags' => 'Laravel, Eloquent, Performa',
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Tutorial: Deploy Laravel ke VPS dengan Nginx',
                'category' => PostCategory::Tutorial,
                'excerpt' => 'Langkah ringkas menyiapkan server, memasang PHP, mengarahkan Nginx, dan mengaktifkan HTTPS untuk aplikasi Laravel.',
                'body' => <<<'MARKDOWN'
                Tutorial ini merangkum alur deploy Laravel ke VPS yang saya pakai untuk proyek kecil: satu server, Nginx, dan PHP-FPM.

                ## 1. Siapkan server

                Perbarui paket, buat pengguna non-root, dan pasang PHP beserta ekstensinya:

                ```bash
                sudo apt update && sudo apt upgrade -y
                sudo apt install nginx php-fpm php-mysql php-mbstring php-xml unzip -y
                ```

                ## 2. Ambil kode dan pasang dependensi

                ```bash
                git clone git@github.com:akdar/portofolio.git /var/www/portofolio
                cd /var/www/portofolio
                composer install --no-dev --optimize-autoloader
                npm ci && npm run build
                ```

                ## 3. Konfigurasi Nginx

                Arahkan root ke folder `public`, lalu teruskan request PHP ke PHP-FPM:

                ```nginx
                server {
                    listen 80;
                    server_name portofolio.example.com;
                    root /var/www/portofolio/public;

                    index index.php;

                    location / {
                        try_files $uri $uri/ /index.php?$query_string;
                    }

                    location ~ \.php$ {
                        fastcgi_pass unix:/run/php/php-fpm.sock;
                        include fastcgi_params;
                        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
                    }
                }
                ```

                ## 4. Selesaikan konfigurasi aplikasi

                ```bash
                cp .env.example .env
                php artisan key:generate
                php artisan migrate --force
                php artisan config:cache
                ```

                Terakhir, pasang sertifikat HTTPS dengan Certbot dan pastikan `APP_ENV` serta `APP_DEBUG` sudah benar.
                MARKDOWN,
                'tags' => 'Laravel, Deployment, Nginx',
                'is_published' => true,
                'published_at' => now()->subDay(),
            ],
        ];

        foreach ($posts as $post) {
            Post::query()->updateOrCreate(
                ['title' => $post['title']],
                [...$post, 'cover_path' => null],
            );
        }
    }
}
