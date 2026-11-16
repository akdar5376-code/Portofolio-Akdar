<?php

namespace App\Models;

use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

#[Fillable([
    'title',
    'slug',
    'category',
    'description',
    'detail',
    'problem',
    'goal',
    'tech_stack',
    'role',
    'features',
    'thumbnail_path',
    'project_url',
    'github_url',
    'process',
    'user_feedback',
    'is_featured',
    'sort_order',
])]
class Project extends Model
{
    /** @use HasFactory<ProjectFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Project $project): void {
            $project->slug = Str::slug($project->title);
        });
    }

    /**
     * @param  Builder<Project>  $query
     * @return Builder<Project>
     */
    public function scopeOfCategory(Builder $query, ?string $category): Builder
    {
        return $category === null
            ? $query
            : $query->where('category', $category);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getThumbnailUrlAttribute(): string
    {
        if (filled($this->thumbnail_path)) {
            return Storage::disk('public')->url($this->thumbnail_path);
        }

        return asset('images/project-placeholder.svg');
    }

    /**
     * @return list<string>
     */
    public function getTechStackListAttribute(): array
    {
        return collect(preg_split('/[,\n]/', (string) $this->tech_stack))
            ->map(fn (string $item): string => trim($item))
            ->filter()
            ->values()
            ->all();
    }

    /**
     * @return list<string>
     */
    public function getFeatureListAttribute(): array
    {
        return $this->toLines($this->features);
    }

    /**
     * @return list<string>
     */
    public function getProcessStepsAttribute(): array
    {
        return $this->toLines($this->process);
    }

    /**
     * @return list<string>
     */
    private function toLines(?string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $value))
            ->map(fn (string $item): string => trim($item))
            ->filter()
            ->values()
            ->all();
    }
}
