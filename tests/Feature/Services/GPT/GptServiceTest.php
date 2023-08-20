<?php

use App\Services\GPT\Adapters\OpenAiAdapter;
use App\Services\GPT\Enum\GptModelTypes;
use App\Services\GPT\GptService;
use App\Services\GPT\OpenAi\Chat;
use App\Services\GPT\OpenAi\Completions;

it('should generate sentences with Completions openai client', function (array $params) {
    config()->set('openai.model', GptModelTypes::DAVINCI->value);

    $responseMock = mountResponseMock(
        $params['word'],
        $params['qtd_sentences'],
    );

    $client = mockCompletionsOpenAi($responseMock);

    $completions = new Completions($client);
    $openAiAdapter = new OpenAiAdapter($completions);

    $response = (new GptService($openAiAdapter))->generate($params);

    expect($response)->toMatchArray(explode('|', $responseMock));
})
    ->with('params_for_sentences')
    ->group('gpt_service');

it('should generate sentences with Chat openai client', function (array $params) {
    config()->set('openai.model', GptModelTypes::GPT_3->value);

    $responseMock = mountResponseMock(
        $params['word'],
        $params['qtd_sentences'],
    );

    $client = mockChatOpenAi($responseMock);

    $chat = new Chat($client);
    $openAiAdapter = new OpenAiAdapter($chat);

    $response = (new GptService($openAiAdapter))->generate($params);

    expect($response)->toMatchArray(json_decode($responseMock, true));
})->with('params_for_sentences')->group('gpt_service');
