<?php

namespace App\Enums;

enum TestimonyRole: string
{
    case Siswa = 'siswa';
    case Guru = 'guru';
    case Pengguna = 'pengguna';
    case TempatMagang = 'tempat_magang';

    public function label(): string
    {
        return match ($this) {
            self::Siswa => 'Siswa',
            self::Guru => 'Guru',
            self::Pengguna => 'Pengguna',
            self::TempatMagang => 'Tempat Magang',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::Siswa => 'Pesan dan kesan dari teman sesama siswa.',
            self::Guru => 'Penilaian dan pesan dari guru pembimbing.',
            self::Pengguna => 'Umpan balik dari pengguna produk atau aplikasi.',
            self::TempatMagang => 'Penilaian dari pembimbing di tempat magang atau PLK.',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Siswa => 'users',
            self::Guru => 'graduation-cap',
            self::Pengguna => 'message-circle',
            self::TempatMagang => 'briefcase',
        };
    }

    /**
     * @return array<string, string>
     */
    public function accentClasses(): array
    {
        return match ($this) {
            self::Siswa => [
                'badge' => 'border-emerald-500/30 bg-emerald-500/10 text-emerald-600 dark:text-emerald-300',
                'icon' => 'border-emerald-500/30 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
                'dot' => 'bg-emerald-500',
            ],
            self::Guru => [
                'badge' => 'border-blue-500/30 bg-blue-500/10 text-blue-600 dark:text-blue-300',
                'icon' => 'border-blue-500/30 bg-blue-500/10 text-blue-600 dark:text-blue-400',
                'dot' => 'bg-blue-500',
            ],
            self::Pengguna => [
                'badge' => 'border-indigo-500/30 bg-indigo-500/10 text-indigo-600 dark:text-indigo-300',
                'icon' => 'border-indigo-500/30 bg-indigo-500/10 text-indigo-600 dark:text-indigo-400',
                'dot' => 'bg-indigo-500',
            ],
            self::TempatMagang => [
                'badge' => 'border-amber-500/30 bg-amber-500/10 text-amber-600 dark:text-amber-300',
                'icon' => 'border-amber-500/30 bg-amber-500/10 text-amber-600 dark:text-amber-400',
                'dot' => 'bg-amber-500',
            ],
        };
    }
}
