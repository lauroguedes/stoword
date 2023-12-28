<?php

use App\Services\GPT\Adapters\OpenAiAdapter;
use App\Services\GPT\Enum\GptModelTypes;
use App\Services\GPT\GptService;
use App\Services\GPT\OpenAi\Chat;
use App\Services\GPT\OpenAi\Completions;

beforeEach(function () {
    authAs();

    $this->prompt = 'word';
});

function completionAdapter($responseMock): OpenAiAdapter
{
    $client = mockCompletionsOpenAi($responseMock);

    $completions = new Completions($client);
    return new OpenAiAdapter($completions);
}

function chatAdapter($responseMock): OpenAiAdapter
{
    $client = mockChatOpenAi($responseMock);

    $chat = new Chat($client);
    return new OpenAiAdapter($chat);
}

it('should generate sentences with Completions openai client', function () {
    config()->set('openai.model', GptModelTypes::DAVINCI->value);

    $responseMock = mountResponseMock($this->prompt);

    $response = (new GptService(completionAdapter($responseMock)))->generate($this->prompt);

    expect($response)->toMatchArray(json_decode($responseMock, true));
});

it('should not generate sentences with Completion because json invalid', function () {
    config()->set('openai.model', GptModelTypes::DAVINCI->value);

    $responseMock = 'invalid json';

    expect(fn () => (new GptService(completionAdapter($responseMock)))->generate($this->prompt))
        ->toThrow('Response json invalid');
});

it('should generate sentences with Chat openai client', function () {
    config()->set('openai.model', GptModelTypes::GPT_3->value);

    $responseMock = mountResponseMock($this->prompt);

    $response = (new GptService(chatAdapter($responseMock)))->generate($this->prompt);

    expect($response)->toMatchArray(json_decode($responseMock, true));
});

it('should not generate sentences with Chat because json invalid', function () {
    config()->set('openai.model', GptModelTypes::GPT_3->value);

    $responseMock = 'invalid json';

    expect(fn () => (new GptService(chatAdapter($responseMock)))->generate($this->prompt))
        ->toThrow('Response json invalid');
});
