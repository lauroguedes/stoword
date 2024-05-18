<?php

use App\Jobs\SaveWordAndCreateHistoricJob;
use App\Models\Word;
use App\Services\DTOs\WordDto;
use App\Services\GPT\Adapters\OpenAiAdapter;
use App\Services\GPT\Enum\GptModelTypes;
use App\Services\GPT\GptService;
use App\Services\GPT\OpenAi\Chat;
use App\Services\GPT\OpenAi\Completions;

beforeEach(function () {
    authAs();

    $this->prompt = 'word';
});

function getGptAdapter($responseMock, $model): array
{
    return match ($model) {
        GptModelTypes::DAVINCI->value => completionAdapter($responseMock),
        GptModelTypes::GPT_3->value => chatAdapter($responseMock),
    };
}

function completionAdapter($responseMock): array
{
    $client = mockCompletionsOpenAi($responseMock);

    $completions = new Completions($client);

    return [
        'adapter' => new OpenAiAdapter($completions),
        'mock' => $client->completions(),
    ];
}

function chatAdapter($responseMock): array
{
    $client = mockChatOpenAi($responseMock);

    $chat = new Chat($client);

    return [
        'adapter' => new OpenAiAdapter($chat),
        'mock' => $client->chat(),
    ];
}

it('should generate word data straight from api request', function (string $model) {
    Queue::fake();

    config()->set('openai.model', $model);

    $responseMock = mountResponseMock($this->prompt);

    $gpt = getGptAdapter($responseMock, $model);

    $response = (new GptService($gpt['adapter']))->generate($this->prompt);

    $gpt['mock']->assertSent();

    Queue::assertPushed(SaveWordAndCreateHistoricJob::class, function ($job) {
        return $job->data['name'] === $this->prompt;
    });

    $expectedData = WordDto::fromJson($responseMock)->toArray();

    expect($response)->toMatchArray($expectedData)
        ->and(cache()->get($this->prompt))->toMatchArray($expectedData);
})->with([
    'completion' => GptModelTypes::DAVINCI->value,
    'chat' => GptModelTypes::GPT_3->value,
]);

it('should not generate word data because required properties came empty', function (string $model) {
    Queue::fake();

    config()->set('openai.model', $model);

    $responseMock = json_encode([
        'word' => '',
        'ipa_word' => '',
        'translate' => '',
        'meaning' => [
            'value' => '',
            'translate' => '',
        ],
        'part_of_speech' => '',
        'plural' => '',
        'synonyms' => '',
        'word_forms' => '',
        'sentences' => [
            [
                'value' => '',
                'translate' => '',
            ],
        ],
    ]);

    Queue::assertNotPushed(SaveWordAndCreateHistoricJob::class);

    $gpt = getGptAdapter($responseMock, $model);

    expect(fn () => (new GptService($gpt['adapter']))->generate($this->prompt))
        ->toThrow('Required properties missing')
        ->and(cache()->get($this->prompt))->toBeNull();

    $gpt['mock']->assertSent();
})->with([
    'completion' => GptModelTypes::DAVINCI->value,
    'chat' => GptModelTypes::GPT_3->value,
]);

it('should not generate word data because invalid json', function (string $model) {
    Queue::fake();

    config()->set('openai.model', $model);

    $responseMock = 'invalid json';

    Queue::assertNotPushed(SaveWordAndCreateHistoricJob::class);

    $gpt = getGptAdapter($responseMock, $model);

    expect(fn () => (new GptService($gpt['adapter']))->generate($this->prompt))
        ->toThrow('Response json invalid')
        ->and(cache()->get($this->prompt))->toBeNull();

    $gpt['mock']->assertSent();
})->with([
    'completion' => GptModelTypes::DAVINCI->value,
    'chat' => GptModelTypes::GPT_3->value,
]);

it('should generate word data straight from database', function (string $model) {
    Queue::fake();

    config()->set('openai.model', $model);

    $wordData = Word::factory()->create();

    $gpt = getGptAdapter($wordData->toJson(), $model);

    $response = (new GptService($gpt['adapter']))->generate($wordData->name);

    $gpt['mock']->assertNotSent();

    Queue::assertPushed(SaveWordAndCreateHistoricJob::class, function ($job) use ($wordData) {
        return $job->data['name'] === $wordData->name;
    });

    expect($response)->toMatchArray($wordData->toArray())
        ->and(cache()->get($wordData->name))->toMatchArray($wordData->toArray());
})->with([
    'completion' => GptModelTypes::DAVINCI->value,
    'chat' => GptModelTypes::GPT_3->value,
]);

it('should generate word data straight from cache', function (string $model) {
    Queue::fake();

    config()->set('openai.model', $model);

    $responseMock = mountResponseMock($this->prompt);

    $gpt = getGptAdapter($responseMock, $model);

    $expectedData = WordDto::fromJson($responseMock)->toArray();

    Cache::shouldReceive('remember')
        ->once()
        ->andReturn($expectedData);

    $response = (new GptService($gpt['adapter']))->generate($this->prompt);

    $gpt['mock']->assertNotSent();

    Queue::assertPushed(SaveWordAndCreateHistoricJob::class, function ($job) {
        return $job->data['name'] === $this->prompt;
    });

    expect($response)->toMatchArray($expectedData);
})->with([
    'completion' => GptModelTypes::DAVINCI->value,
    'chat' => GptModelTypes::GPT_3->value,
]);

it('should throw exception because return empty word data', function (string $model) {
    Queue::fake();

    config()->set('openai.model', $model);

    $responseMock = mountResponseMock($this->prompt);

    $gpt = getGptAdapter($responseMock, $model);

    Cache::shouldReceive('remember')
        ->once()
        ->andReturn([]);

    expect(fn() => (new GptService($gpt['adapter']))->generate($this->prompt))
        ->toThrow('Word data not found');

    $gpt['mock']->assertNotSent();

    Queue::assertNotPushed(SaveWordAndCreateHistoricJob::class);
})->with([
    'completion' => GptModelTypes::DAVINCI->value,
    'chat' => GptModelTypes::GPT_3->value,
]);

