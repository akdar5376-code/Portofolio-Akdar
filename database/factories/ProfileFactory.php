<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => 'Muhammad Akdar',
            'role' => 'Junior Developer',
            'class_name' => 'XII RPL 1',
            'competency' => 'Rekayasa Perangkat Lunak',
            'tagline' => 'Membangun solusi digital melalui kode yang bersih dan efisien.',
            'bio' => fake()->paragraph(3),
            'email' => 'akdar@example.com',
            'github_url' => 'https://github.com/akdar',
            'instagram_url' => 'https://instagram.com/akdar',
            'linkedin_url' => 'https://linkedin.com/in/akdar',
            'career_goal' => fake()->sentence(12),
            'interests' => 'Web Development, Mobile Development, Internet of Things',
        ];
    }
}
