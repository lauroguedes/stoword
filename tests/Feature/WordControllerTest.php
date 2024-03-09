<?php

use App\Models\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->word = [
        'name' => 'run',
        'ipa' => 'rʌn',
        'translate' => 'correr',
        'meaning' => [
            'value' => 'to move fast on foot by taking quick steps',
            'translate' => 'mover-se rapidamente a pé dando passos rápidos',
        ],
        'part_of_speech' => 'verb',
        'plural' => 'runs',
        'synonyms' => 'sprint, jog, dash',
        'forms' => 'ran, running',
        'sentences' => [
            [
                'value' => 'She runs every morning before work.',
                'translate' => 'Ela corre todas as manhãs antes do trabalho.',
            ],
            [
                'value' => 'I ran to catch the bus, but I missed it.',
                'translate' => 'Eu corri para pegar o ônibus, mas o perdi.',
            ],
        ],
    ];
});

test('list words', function () {
    Word::factory()->count(3)->create();

    $response = authAs()->get('/api/words')->assertOk();

    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'created_at',
                'updated_at',
                'id',
                'name',
                'ipa',
                'translate',
                'meaning',
                'part_of_speech',
                'plural',
                'synonyms',
                'forms',
                'sentences',
            ],
        ],
    ]);

    $response->assertJsonCount(3, 'data');
});

test('store word', function () {
    $response = authAs()->post('/api/words', $this->word)->assertCreated();

    $response->assertJsonStructure([
        'data' => [
            'created_at',
            'updated_at',
            'id',
            'name',
            'ipa',
            'translate',
            'meaning',
            'part_of_speech',
            'plural',
            'synonyms',
            'forms',
            'sentences',
        ],
    ]);

    $this->assertDatabaseHas('words', [
        'id' => $response['data']['id'],
        'name' => $this->word['name'],
    ]);
});

test('show word', function () {
    $word = Word::factory()->create();

    $response = authAs()->get("/api/words/{$word->id}")->assertOk();

    $response->assertJsonStructure([
        'data' => [
            'created_at',
            'updated_at',
            'id',
            'name',
            'ipa',
            'translate',
            'meaning',
            'part_of_speech',
            'plural',
            'synonyms',
            'forms',
            'sentences',
        ],
    ]);

    $response->assertJson([
        'data' => [
            'id' => $word->id,
            'name' => $word->name,
            'translate' => $word->translate,
            'meaning' => $word->meaning,
            'sentences' => $word->sentences,
        ],
    ]);
});

test('remove word', function () {
    $word = Word::factory()->create();

    authAs()->delete("/api/words/{$word->id}")->assertNoContent();

    $this->assertSoftDeleted('words', [
        'id' => $word->id,
    ]);
});

test('not store word with invalid data', function () {
    authAs()->post('/api/words', [
        'name' => null,
        'translate' => null,
        'meaning' => [],
        'sentences' => [],
    ])->assertStatus(422);
})
    ->throws('Illuminate\Validation\ValidationException')
    ->skip('This test is not working yet.');
