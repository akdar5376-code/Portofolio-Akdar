<?php

namespace App\Enums;

enum ProjectCategory: string
{
    case Web = 'Web';
    case Mobile = 'Mobile';
    case IoT = 'IoT';

    /**
     * @return list<self>
     */
    public static function values(): array
    {
        return array_map(fn (self $case): string => $case->value, self::cases());
    }

    public function label(): string
    {
        return match ($this) {
            self::Web => 'Web Development',
            self::Mobile => 'Mobile Development',
            self::IoT => 'IoT / Embedded System',
        };
    }

    public function shortLabel(): string
    {
        return match ($this) {
            self::Web => 'Web',
            self::Mobile => 'Mobile',
            self::IoT => 'IoT',
        };
    }

    public function accent(): string
    {
        return match ($this) {
            self::Web => 'orange',
            self::Mobile => 'stone',
            self::IoT => 'stone',
        };
    }

    /**
     * @return array<string, string>
     */
    public function accentClasses(): array
    {
        return match ($this) {
            self::Web => [
                'badge' => 'bg-orange-500/10 text-orange-800 dark:text-orange-300 border-orange-500/30',
                'dot' => 'bg-orange-400',
                'title' => 'group-hover:text-orange-400',
                'hover' => 'hover:border-orange-400/50',
                'thumb' => 'group-hover:border-orange-400/40',
            ],
            self::Mobile => [
                'badge' => 'bg-amber-500/10 text-amber-800 dark:text-amber-300 border-amber-500/30',
                'dot' => 'bg-amber-400',
                'title' => 'group-hover:text-amber-400',
                'hover' => 'hover:border-amber-400/50',
                'thumb' => 'group-hover:border-amber-400/40',
            ],
            self::IoT => [
                'badge' => 'bg-stone-500/10 text-stone-700 dark:text-stone-300 border-stone-500/30',
                'dot' => 'bg-stone-400',
                'title' => 'group-hover:text-stone-400',
                'hover' => 'hover:border-stone-400/50',
                'thumb' => 'group-hover:border-stone-400/40',
            ],
        };
    }
}
