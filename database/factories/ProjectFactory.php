<?php

namespace Database\Factories;

use App\Enums\ProjectCategory;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->words(3, true);

        return [
            'title' => Str::title($title),
            'category' => fake()->randomElement(ProjectCategory::cases()),
            'description' => fake()->sentence(12),
            'detail' => fake()->paragraph(4),
            'problem' => fake()->sentence(14),
            'goal' => fake()->sentence(14),
            'tech_stack' => 'Laravel, Tailwind CSS, MySQL',
            'role' => 'Full Stack Developer',
            'features' => "Autentikasi pengguna\nDashboard admin\nLaporan otomatis",
            'thumbnail_path' => null,
            'project_url' => null,
            'github_url' => null,
            'process' => "Analisis kebutuhan\nDesain antarmuka\nImplementasi\nPengujian",
            'user_feedback' => fake()->sentence(16),
            'is_featured' => false,
            'sort_order' => fake()->numberBetween(0, 20),
        ];
    }

    public function ofCategory(ProjectCategory $category): static
    {
        return $this->state(fn (): array => ['category' => $category]);
    }
}
