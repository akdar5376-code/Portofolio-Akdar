<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Portfolio Owner
    |--------------------------------------------------------------------------
    |
    | Single source of truth untuk data pemilik portofolio yang dipakai pada
    | halaman publik (hero, CTA, footer) dan panel admin.
    |
    */

    'owner' => [
        'name' => env('PORTFOLIO_OWNER_NAME', 'Muhammad Akdar'),
        'role' => env('PORTFOLIO_OWNER_ROLE', 'Junior Developer'),
        'school' => env('PORTFOLIO_OWNER_SCHOOL', 'SMKN 2 Banjarmasin'),
        'motto' => env('PORTFOLIO_OWNER_MOTTO', 'Membangun solusi digital melalui kode yang bersih dan efisien.'),
        'email' => env('PORTFOLIO_OWNER_EMAIL', 'akdar5376@gmail.com'),
        'github' => env('PORTFOLIO_OWNER_GITHUB', 'https://github.com'),
        'instagram' => env('PORTFOLIO_OWNER_INSTAGRAM', 'https://instagram.com'),
        'linkedin' => env('PORTFOLIO_OWNER_LINKEDIN', 'https://linkedin.com'),
    ],

];
