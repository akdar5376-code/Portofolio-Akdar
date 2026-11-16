<?php

namespace Database\Factories;

use App\Enums\PostCategory;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => Str::title(fake()->unique()->words(4, true)),
            'category' => fake()->randomElement(PostCategory::cases()),
            'excerpt' => fake()->sentence(15),
            'body' => fake()->paragraphs(4, true),
            'cover_path' => null,
            'tags' => 'Laravel, Tailwind CSS, Tips',
            'is_published' => true,
            'published_at' => now()->subDays(fake()->numberBetween(1, 30)),
        ];
    }

    public function draft(): static
    {
        return $this->state(fn (): array => [
            'is_published' => false,
            'published_at' => null,
        ]);
    }

    public function ofCategory(PostCategory $category): static
    {
        return $this->state(fn (): array => ['category' => $category]);
    }
}
