<?php

namespace Database\Factories;

use App\Models\Certificate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Certificate>
 */
class CertificateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'issuer' => fake()->company(),
            'year' => (string) fake()->year(),
            'credential_url' => fake()->url(),
            'description' => fake()->sentence(12),
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
