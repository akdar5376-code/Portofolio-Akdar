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
            self::Hard => 'blue',
            self::Soft => 'emerald',
        };
    }

    /**
     * @return array<string, string>
     */
    public function barClasses(): array
    {
        return match ($this) {
            self::Hard => [
                'badge' => 'border-blue-500/30 bg-blue-500/10 text-blue-500 dark:text-blue-300',
                'bar' => 'bg-gradient-to-r from-blue-600 to-cyan-400',
                'text' => 'text-blue-600 dark:text-blue-300',
            ],
            self::Soft => [
                'badge' => 'border-emerald-500/30 bg-emerald-500/10 text-emerald-600 dark:text-emerald-300',
                'bar' => 'bg-gradient-to-r from-emerald-600 to-teal-400',
                'text' => 'text-emerald-600 dark:text-emerald-300',
            ],
        };
    }
}
