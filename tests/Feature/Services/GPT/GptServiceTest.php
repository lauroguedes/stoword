<?php

use App\Services\GPT\Enum\GptModelTypes;
use App\Services\GPT\GptService;

it('should generate sentences with Completions openai client', function (array $params) {
    config()->set('openai.model', GptModelTypes::DAVINCI->value);

    $responseMock = mountResponseMock(
        $params['word'],
        $params['qtd_sentences'],
    );

    mockCompletionsOpenAi($responseMock);

    $response = app(GptService::class)->generate($params);

    expect($response)->toMatchArray(explode('|', $responseMock));
})->with('params_for_sentences')->group('gpt_service');

it('should generate sentences with Chat openai client', function (array $params) {
    config()->set('openai.model', GptModelTypes::GPT_3->value);

    $responseMock = mountResponseMock(
        $params['word'],
        $params['qtd_sentences'],
    );

    mockChatOpenAi($responseMock);

    $response = app(GptService::class)->generate($params);

    expect($response)->toMatchArray(explode('|', $responseMock));
})->with('params_for_sentences')->group('gpt_service');
