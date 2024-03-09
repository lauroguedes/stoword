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
            'name' => $this->faker->name(),
            'ipa' => $this->faker->word(),
            'translate' => $this->faker->word(),
            'meaning' => $this->faker->words(),
            'part_of_speech' => $this->faker->word(),
            'plural' => $this->faker->word(),
            'synonyms' => $this->faker->word(),
            'forms' => $this->faker->word(),
            'sentences' => $this->faker->words(),
        ];
    }
}
