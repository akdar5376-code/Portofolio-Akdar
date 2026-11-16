<?php

namespace Database\Factories;

use App\Enums\ExperienceType;
use App\Models\Experience;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Experience>
 */
class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'organization' => fake()->company(),
            'type' => fake()->randomElement(ExperienceType::cases()),
            'period' => fake()->year().' - '.fake()->year(),
            'description' => fake()->paragraph(2),
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }

    public function ofType(ExperienceType $type): static
    {
        return $this->state(fn (): array => ['type' => $type]);
    }
}
