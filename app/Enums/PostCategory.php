<?php

namespace App\Enums;

enum PostCategory: string
{
    case Artikel = 'Artikel';
    case Catatan = 'Catatan';
    case Tutorial = 'Tutorial';

    /**
     * @return list<string>
     */
    public static function values(): array
    {
        return array_map(fn (self $case): string => $case->value, self::cases());
    }

    public function label(): string
    {
        return match ($this) {
            self::Artikel => 'Artikel',
            self::Catatan => 'Catatan Ngoding',
            self::Tutorial => 'Tutorial',
        };
    }

    public function shortLabel(): string
    {
        return match ($this) {
            self::Artikel => 'Artikel',
            self::Catatan => 'Catatan',
            self::Tutorial => 'Tutorial',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Artikel => 'file-text',
            self::Catatan => 'terminal',
            self::Tutorial => 'lightbulb',
        };
    }

    /**
     * @return array<string, string>
     */
    public function accentClasses(): array
    {
        return match ($this) {
            self::Artikel => [
                'badge' => 'bg-orange-500/10 text-orange-800 dark:text-orange-300 border-orange-500/30',
                'dot' => 'bg-orange-400',
                'title' => 'group-hover:text-orange-400',
                'hover' => 'hover:border-orange-400/50',
            ],
            self::Catatan => [
                'badge' => 'bg-stone-500/10 text-stone-700 dark:text-stone-300 border-stone-500/30',
                'dot' => 'bg-stone-400',
                'title' => 'group-hover:text-stone-400',
                'hover' => 'hover:border-stone-400/50',
            ],
            self::Tutorial => [
                'badge' => 'bg-amber-500/10 text-amber-800 dark:text-amber-300 border-amber-500/30',
                'dot' => 'bg-stone-400',
                'title' => 'group-hover:text-stone-400',
                'hover' => 'hover:border-amber-400/50',
            ],
        };
    }
}
