<?php

use App\Jobs\SaveWordAndCreateHistoricJob;
use App\Models\User;
use App\Models\Word;
use App\Services\DTOs\WordDto;

test('should save word and create historic for user', function () {
    $user = User::factory()->create();
    $word = mountResponseMock('word', false);
    $responseData = WordDto::fromJson($word)->toArray();

    SaveWordAndCreateHistoricJob::dispatch($responseData, $user);

    $this->assertDatabaseHas('words', [
        'name' => $responseData['name'],
    ]);

    $this->assertDatabaseHas('user_word', [
        'user_id' => $user->id,
    ]);
});

test('should not save word and create historic for user because word exists', function () {
    $user = User::factory()->create();
    $word = mountResponseMock('word', false);
    $responseData = WordDto::fromJson($word)->toArray();

    $word = Word::factory()->create($responseData);

    SaveWordAndCreateHistoricJob::dispatch($responseData, $user);

    $this->assertDatabaseCount('words', 1);

    $this->assertDatabaseHas('user_word', [
        'user_id' => $user->id,
        'word_id' => $word->id,
    ]);
});

test('should not save word and not create historic for user because user already has word', function () {
    $user = User::factory()->create();
    $word = mountResponseMock('word', false);
    $responseData = WordDto::fromJson($word)->toArray();

    $word = Word::factory()->create($responseData);
    $word->users()->attach($user->id);

    SaveWordAndCreateHistoricJob::dispatch($responseData, $user);

    $this->assertDatabaseCount('words', 1);
    $this->assertDatabaseCount('user_word', 1);

    $this->assertDatabaseHas('user_word', [
        'user_id' => $user->id,
        'word_id' => $word->id,
    ]);
});
