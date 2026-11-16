<?php

namespace App\Models;

use App\Enums\SkillType;
use Database\Factories\SkillFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'type', 'percentage', 'icon', 'sort_order'])]
class Skill extends Model
{
    /** @use HasFactory<SkillFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => SkillType::class,
            'percentage' => 'integer',
        ];
    }

    /**
     * @param  Builder<Skill>  $query
     * @return Builder<Skill>
     */
    public function scopeOfType(Builder $query, SkillType $type): Builder
    {
        return $query->where('type', $type->value);
    }

    /**
     * @param  Builder<Skill>  $query
     * @return Builder<Skill>
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
