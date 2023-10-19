<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'native_language' => fake()->languageCode(),
            'level' => fake()->randomElement(['A1', 'A2', 'B1', 'B2', 'C1', 'C2']),
            'qtd_sentences' => fake()->numberBetween(1, 3),
        ];
    }
}
