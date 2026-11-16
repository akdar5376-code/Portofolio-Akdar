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
                'badge' => 'bg-blue-950/80 text-blue-300 border-blue-500/30',
                'dot' => 'bg-blue-400',
                'title' => 'group-hover:text-blue-400',
                'hover' => 'hover:border-blue-400/50 hover:shadow-glow-blue',
            ],
            self::Catatan => [
                'badge' => 'bg-emerald-950/80 text-emerald-300 border-emerald-500/30',
                'dot' => 'bg-emerald-400',
                'title' => 'group-hover:text-emerald-400',
                'hover' => 'hover:border-emerald-400/50 hover:shadow-glow-cyan',
            ],
            self::Tutorial => [
                'badge' => 'bg-indigo-950/80 text-indigo-300 border-indigo-500/30',
                'dot' => 'bg-indigo-400',
                'title' => 'group-hover:text-indigo-400',
                'hover' => 'hover:border-indigo-400/50 hover:shadow-glow-blue',
            ],
        };
    }
}
