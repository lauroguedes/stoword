<?php

namespace Database\Factories;

use App\Models\Word;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class WordFactory extends Factory
{
    protected $model = Word::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->word(),
            'ipa' => $this->faker->word(),
            'translate' => $this->faker->word(),
            'meaning' => $this->faker->sentence(),
            'part_of_speech' => $this->faker->word(),
            'plural' => $this->faker->word(),
            'synonyms' => $this->faker->words(2, true),
            'forms' => $this->faker->words(2, true),
            'sentences' => $this->faker->sentences(2),
        ];
    }
}
