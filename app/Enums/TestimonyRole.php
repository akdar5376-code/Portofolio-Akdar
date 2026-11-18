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
                'badge' => 'border-stone-500/30 bg-stone-500/10 text-stone-600 dark:text-stone-300',
                'icon' => 'border-stone-500/30 bg-stone-500/10 text-stone-600 dark:text-stone-400',
                'dot' => 'bg-stone-500',
            ],
            self::Guru => [
                'badge' => 'border-orange-500/30 bg-orange-500/10 text-orange-600 dark:text-orange-300',
                'icon' => 'border-orange-500/30 bg-orange-500/10 text-orange-600 dark:text-orange-400',
                'dot' => 'bg-orange-500',
            ],
            self::Pengguna => [
                'badge' => 'border-stone-500/30 bg-stone-500/10 text-stone-600 dark:text-stone-300',
                'icon' => 'border-stone-500/30 bg-stone-500/10 text-stone-600 dark:text-stone-400',
                'dot' => 'bg-stone-500',
            ],
            self::TempatMagang => [
                'badge' => 'border-amber-500/30 bg-amber-500/10 text-amber-600 dark:text-amber-300',
                'icon' => 'border-amber-500/30 bg-amber-500/10 text-amber-600 dark:text-amber-400',
                'dot' => 'bg-amber-500',
            ],
        };
    }
}
