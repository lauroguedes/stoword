<?php

beforeEach(function () {
    $this->responseGpt = json_decode(mountResponseMock('word', false), true);
});

test('should return word data with all fields', function () {
    $wordDto = new \App\Services\DTOs\WordDto(
        $this->responseGpt['word'],
        $this->responseGpt['translate'],
        $this->responseGpt['meaning'],
        $this->responseGpt['sentences'],
        $this->responseGpt['part_of_speech'],
        $this->responseGpt['ipa_word'],
        $this->responseGpt['plural'],
        $this->responseGpt['synonyms'],
        $this->responseGpt['word_forms']
    );

    expect($wordDto->name)->toBe($this->responseGpt['word'])
        ->and($wordDto->translate)->toBe($this->responseGpt['translate'])
        ->and($wordDto->meaning)->toBe($this->responseGpt['meaning'])
        ->and($wordDto->sentences)->toBe($this->responseGpt['sentences'])
        ->and($wordDto->part_of_speech)->toBe($this->responseGpt['part_of_speech'])
        ->and($wordDto->ipa)->toBe($this->responseGpt['ipa_word'])
        ->and($wordDto->plural)->toBe($this->responseGpt['plural'])
        ->and($wordDto->synonyms)->toBe($this->responseGpt['synonyms'])
        ->and($wordDto->forms)->toBe($this->responseGpt['word_forms']);
});

test('should return word data from array response', function () {
    $wordDto = \App\Services\DTOs\WordDto::fromArray($this->responseGpt);

    expect($wordDto->name)->toBe($this->responseGpt['word'])
        ->and($wordDto->translate)->toBe($this->responseGpt['translate'])
        ->and($wordDto->meaning)->toBe($this->responseGpt['meaning'])
        ->and($wordDto->sentences)->toBe($this->responseGpt['sentences'])
        ->and($wordDto->part_of_speech)->toBe($this->responseGpt['part_of_speech'])
        ->and($wordDto->ipa)->toBe($this->responseGpt['ipa_word'])
        ->and($wordDto->plural)->toBe($this->responseGpt['plural'])
        ->and($wordDto->synonyms)->toBe($this->responseGpt['synonyms'])
        ->and($wordDto->forms)->toBe($this->responseGpt['word_forms']);
});

test('should return word data from array response to array', function () {
    $wordDto = \App\Services\DTOs\WordDto::fromArray($this->responseGpt);

    expect($wordDto->toArray())->toMatchArray([
        'name' => $this->responseGpt['word'],
        'translate' => $this->responseGpt['translate'],
        'meaning' => $this->responseGpt['meaning'],
        'sentences' => $this->responseGpt['sentences'],
        'part_of_speech' => $this->responseGpt['part_of_speech'],
        'ipa' => $this->responseGpt['ipa_word'],
        'plural' => $this->responseGpt['plural'],
        'synonyms' => $this->responseGpt['synonyms'],
        'forms' => $this->responseGpt['word_forms']
    ]);
});

test('should return word data from json response', function () {
    $wordDto = \App\Services\DTOs\WordDto::fromJson(json_encode($this->responseGpt));

    expect($wordDto->name)->toBe($this->responseGpt['word'])
        ->and($wordDto->translate)->toBe($this->responseGpt['translate'])
        ->and($wordDto->meaning)->toBe($this->responseGpt['meaning'])
        ->and($wordDto->sentences)->toBe($this->responseGpt['sentences'])
        ->and($wordDto->part_of_speech)->toBe($this->responseGpt['part_of_speech'])
        ->and($wordDto->ipa)->toBe($this->responseGpt['ipa_word'])
        ->and($wordDto->plural)->toBe($this->responseGpt['plural'])
        ->and($wordDto->synonyms)->toBe($this->responseGpt['synonyms'])
        ->and($wordDto->forms)->toBe($this->responseGpt['word_forms']);
});

test('should not return word data from invalid json response', function () {
    expect(fn () => \App\Services\DTOs\WordDto::fromJson('invalid json'))
        ->toThrow('String json invalid');
});
