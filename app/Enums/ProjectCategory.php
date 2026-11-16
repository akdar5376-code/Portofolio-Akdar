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
            self::Web => 'blue',
            self::Mobile => 'emerald',
            self::IoT => 'indigo',
        };
    }

    /**
     * @return array<string, string>
     */
    public function accentClasses(): array
    {
        return match ($this) {
            self::Web => [
                'badge' => 'bg-blue-950/80 text-blue-300 border-blue-500/30',
                'dot' => 'bg-blue-400',
                'title' => 'group-hover:text-blue-400',
                'hover' => 'hover:border-blue-400/50 hover:shadow-glow-blue',
                'thumb' => 'group-hover:border-blue-400/40',
            ],
            self::Mobile => [
                'badge' => 'bg-cyan-950/80 text-cyan-300 border-cyan-500/30',
                'dot' => 'bg-cyan-400',
                'title' => 'group-hover:text-cyan-400',
                'hover' => 'hover:border-cyan-400/50 hover:shadow-glow-cyan',
                'thumb' => 'group-hover:border-cyan-400/40',
            ],
            self::IoT => [
                'badge' => 'bg-indigo-950/80 text-indigo-300 border-indigo-500/30',
                'dot' => 'bg-indigo-400',
                'title' => 'group-hover:text-indigo-400',
                'hover' => 'hover:border-indigo-400/50 hover:shadow-glow-blue',
                'thumb' => 'group-hover:border-indigo-400/40',
            ],
        };
    }
}
