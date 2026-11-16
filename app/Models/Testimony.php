<?php

namespace App\Models;

use App\Enums\TestimonyRole;
use Database\Factories\TestimonyFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[Fillable(['name', 'role', 'message', 'is_visible', 'sort_order'])]
class Testimony extends Model
{
    /** @use HasFactory<TestimonyFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'role' => TestimonyRole::class,
            'is_visible' => 'boolean',
        ];
    }

    /**
     * @param  Builder<Testimony>  $query
     * @return Builder<Testimony>
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /**
     * @param  Builder<Testimony>  $query
     * @return Builder<Testimony>
     */
    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_visible', true);
    }

    /**
     * @param  Builder<Testimony>  $query
     * @return Builder<Testimony>
     */
    public function scopeOfRole(Builder $query, ?TestimonyRole $role): Builder
    {
        return $role === null
            ? $query
            : $query->where('role', $role->value);
    }

    public function getInitialsAttribute(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $part): string => Str::upper(Str::substr($part, 0, 1)))
            ->take(2)
            ->implode('');
    }
}
