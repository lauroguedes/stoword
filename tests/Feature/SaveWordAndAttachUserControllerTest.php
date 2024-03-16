<?php

use App\Models\User;
use App\Models\Word;

beforeEach(function () {
    $this->word = [
        'name' => 'run',
        'ipa' => 'rʌn',
        'translate' => 'correr',
        'meaning' => [
            'value' => 'to move fast on foot by taking quick steps',
            'translate' => 'mover-se rapidamente a pe dando passos rapidos',
        ],
        'part_of_speech' => 'verb',
        'plural' => 'runs',
        'synonyms' => 'sprint, jog, dash',
        'forms' => 'ran, running',
        'sentences' => [
            [
                'value' => 'She runs every morning before work.',
                'translate' => 'Ela corre todas as manhas antes do trabalho.',
            ],
            [
                'value' => 'I ran to catch the bus, but I missed it.',
                'translate' => 'Eu corri para pegar o onibus, mas o perdi.',
            ],
        ],
    ];
});

test('save word and attach user', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->postJson('api/words/save', $this->word)
        ->assertCreated();

    $this->assertDatabaseHas('words', [
        'id' => $response->json('id'),
    ]);

    $this->assertDatabaseHas('user_word', [
        'user_id' => $user->id,
        'word_id' => $response->json('id')
    ]);
});

test('attach user with word already saved', function () {
    $user = User::factory()->create();
    $word = Word::factory()->create();

    $this->actingAs($user)
        ->postJson('api/words/save', $word->toArray())
        ->assertCreated();

    $this->assertDatabaseCount('words', 1);

    $this->assertDatabaseHas('user_word', [
        'user_id' => $user->id,
        'word_id' => $word->id
    ]);
});

test('not attach user with word already attached', function () {
    $word = Word::factory()->create();
    $user = User::factory()->hasAttached($word)->create();

    $this->actingAs($user)
        ->postJson('api/words/save', $word->toArray())
        ->assertNoContent();

    $this->assertDatabaseCount('words', 1);
    $this->assertDatabaseCount('user_word', 1);
});
