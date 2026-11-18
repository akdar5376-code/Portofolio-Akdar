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
                'badge' => 'border-orange-500/30 bg-orange-500/10 text-orange-600 dark:text-orange-300',
                'icon' => 'border-orange-500/30 bg-orange-500/10 text-orange-600 dark:text-orange-400',
                'dot' => 'bg-orange-500',
            ],
            self::Organization => [
                'badge' => 'border-stone-500/30 bg-stone-500/10 text-stone-600 dark:text-stone-300',
                'icon' => 'border-stone-500/30 bg-stone-500/10 text-stone-600 dark:text-stone-400',
                'dot' => 'bg-stone-500',
            ],
            self::Competition => [
                'badge' => 'border-amber-500/30 bg-amber-500/10 text-amber-600 dark:text-amber-300',
                'icon' => 'border-amber-500/30 bg-amber-500/10 text-amber-600 dark:text-amber-400',
                'dot' => 'bg-amber-500',
            ],
        };
    }
}
