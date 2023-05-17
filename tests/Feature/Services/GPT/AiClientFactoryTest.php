<?php

use App\Services\GPT\AiClientContract;
use App\Services\GPT\Enum\GptModelTypes;
use App\Services\GPT\Factories\AiClientFactory;
use App\Services\GPT\OpenAi\Chat;
use App\Services\GPT\OpenAi\Completions;

it('model string or GptModelTypes instance passed should return an AiClientContract instance', function ($model) {
    $instance = (new AiClientFactory())->factory($model);

    expect($instance)->toBeInstanceOf(AiClientContract::class);
})
    ->with([
        GptModelTypes::GPT_3->value,
        GptModelTypes::DAVINCI->value,
        GptModelTypes::GPT_3,
        GptModelTypes::DAVINCI,
    ])
    ->group('factories');

it('should return a Chat instance if the model is gpt-3', function () {
    $model = GptModelTypes::GPT_3->value;

    config()->set('openai.model', $model);

    $chatInstance = (new AiClientFactory())->factory($model);

    expect($chatInstance)->toBeInstanceOf(Chat::class);
})->group('factories');

it('should return a Completions instance if the model is davinci', function () {
    $model = GptModelTypes::DAVINCI->value;

    config()->set('openai.model', $model);

    $chatInstance = (new AiClientFactory())->factory($model);

    expect($chatInstance)->toBeInstanceOf(Completions::class);
})->group('factories');

it('should throw exception if model do not exists', function () {
    $model = 'model-anyone';

    config()->set('openai.model', $model);

    expect(fn () => (new AiClientFactory())->factory($model))->toThrow(ValueError::class, 'Invalid model expected');
})->group('factories');

it('should throw exception if class returned is not AiClientContract instance', function () {
    $model = GptModelTypes::GPT_3->value;

    config()->set('openai.model', $model);

    expect(fn () => (new AiClientFactory())->factory($model))->toThrow(Exception::class, 'Invalid AI Client Service');
})->group('factories')->skip('To need to mock the GptModelTypes method');
