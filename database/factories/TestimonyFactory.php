<?php

namespace Database\Factories;

use App\Enums\TestimonyRole;
use App\Models\Testimony;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Testimony>
 */
class TestimonyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'role' => fake()->randomElement(TestimonyRole::cases()),
            'message' => fake()->paragraph(),
            'is_visible' => true,
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }

    public function siswa(): static
    {
        return $this->state(fn (): array => ['role' => TestimonyRole::Siswa]);
    }

    public function guru(): static
    {
        return $this->state(fn (): array => ['role' => TestimonyRole::Guru]);
    }

    public function pengguna(): static
    {
        return $this->state(fn (): array => ['role' => TestimonyRole::Pengguna]);
    }

    public function tempatMagang(): static
    {
        return $this->state(fn (): array => ['role' => TestimonyRole::TempatMagang]);
    }
}
