<?php

namespace App\Enums;

enum ExperienceType: string
{
    case Plk = 'plk';
    case Organization = 'organization';
    case Competition = 'competition';

    public function label(): string
    {
        return match ($this) {
            self::Plk => 'Praktik Kerja Lapangan',
            self::Organization => 'Organisasi & Kepanitiaan',
            self::Competition => 'Lomba & Kompetisi',
        };
    }

    public function shortLabel(): string
    {
        return match ($this) {
            self::Plk => 'PLK',
            self::Organization => 'Organisasi',
            self::Competition => 'Lomba',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Plk => 'briefcase',
            self::Organization => 'users',
            self::Competition => 'trophy',
        };
    }

    /**
     * @return array<string, string>
     */
    public function accentClasses(): array
    {
        return match ($this) {
            self::Plk => [
                'badge' => 'border-blue-500/30 bg-blue-500/10 text-blue-600 dark:text-blue-300',
                'icon' => 'border-blue-500/30 bg-blue-500/10 text-blue-600 dark:text-blue-400',
                'dot' => 'bg-blue-500',
            ],
            self::Organization => [
                'badge' => 'border-indigo-500/30 bg-indigo-500/10 text-indigo-600 dark:text-indigo-300',
                'icon' => 'border-indigo-500/30 bg-indigo-500/10 text-indigo-600 dark:text-indigo-400',
                'dot' => 'bg-indigo-500',
            ],
            self::Competition => [
                'badge' => 'border-amber-500/30 bg-amber-500/10 text-amber-600 dark:text-amber-300',
                'icon' => 'border-amber-500/30 bg-amber-500/10 text-amber-600 dark:text-amber-400',
                'dot' => 'bg-amber-500',
            ],
        };
    }
}
