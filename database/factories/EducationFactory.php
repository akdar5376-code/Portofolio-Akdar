<?php

namespace Database\Factories;

use App\Models\Education;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Education>
 */
class EducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'institution' => fake()->company(),
            'level' => fake()->randomElement(['SD', 'SMP', 'SMK']),
            'period' => fake()->year().' - '.fake()->year(),
            'description' => fake()->sentence(10),
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
