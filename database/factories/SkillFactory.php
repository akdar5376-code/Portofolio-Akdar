<?php

namespace Database\Factories;

use App\Enums\SkillType;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Laravel', 'Tailwind CSS', 'MySQL', 'JavaScript', 'Flutter', 'Komunikasi', 'Kerja Sama Tim']),
            'type' => fake()->randomElement(SkillType::cases()),
            'percentage' => fake()->numberBetween(60, 95),
            'icon' => 'code',
            'sort_order' => fake()->numberBetween(0, 20),
        ];
    }

    public function ofType(SkillType $type): static
    {
        return $this->state(fn (): array => ['type' => $type]);
    }
}
