<?php

namespace App\Enums;

enum SkillType: string
{
    case Hard = 'hard';
    case Soft = 'soft';

    public function label(): string
    {
        return match ($this) {
            self::Hard => 'Hard Skill',
            self::Soft => 'Soft Skill',
        };
    }

    public function accent(): string
    {
        return match ($this) {
            self::Hard => 'orange',
            self::Soft => 'stone',
        };
    }

    /**
     * @return array<string, string>
     */
    public function barClasses(): array
    {
        return match ($this) {
            self::Hard => [
                'badge' => 'border-orange-500/30 bg-orange-500/10 text-orange-500 dark:text-orange-300',
                'bar' => 'bg-orange-800',
                'text' => 'text-orange-600 dark:text-orange-300',
            ],
            self::Soft => [
                'badge' => 'border-stone-500/30 bg-stone-500/10 text-stone-600 dark:text-stone-300',
                'bar' => 'bg-stone-600',
                'text' => 'text-stone-600 dark:text-stone-300',
            ],
        };
    }
}
