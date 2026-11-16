<?php

namespace App\Models;

use App\Enums\PostCategory;
use Database\Factories\PostFactory;
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
    'excerpt',
    'body',
    'cover_path',
    'tags',
    'is_published',
    'published_at',
])]
class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'category' => PostCategory::class,
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Post $post): void {
            $post->slug = Str::slug($post->title);
        });
    }

    /**
     * @param  Builder<Post>  $query
     * @return Builder<Post>
     */
    public function scopeOfCategory(Builder $query, ?PostCategory $category): Builder
    {
        return $category === null
            ? $query
            : $query->where('category', $category->value);
    }

    /**
     * @param  Builder<Post>  $query
     * @return Builder<Post>
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('is_published', true)
            ->where(function (Builder $query): void {
                $query->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function isVisible(): bool
    {
        return $this->is_published
            && ($this->published_at === null || $this->published_at->lessThanOrEqualTo(now()));
    }

    public function getCoverUrlAttribute(): string
    {
        if (filled($this->cover_path)) {
            return Storage::disk('public')->url($this->cover_path);
        }

        return asset('images/blog-placeholder.svg');
    }

    /**
     * @return list<string>
     */
    public function getTagListAttribute(): array
    {
        return collect(preg_split('/[,\n]/', (string) $this->tags))
            ->map(fn (string $item): string => trim($item))
            ->filter()
            ->values()
            ->all();
    }

    public function getReadingMinutesAttribute(): int
    {
        $words = Str::wordCount(strip_tags((string) $this->body));

        return max(1, (int) ceil($words / 200));
    }

    public function getBodyHtmlAttribute(): string
    {
        return Str::markdown((string) $this->body);
    }
}
