<?php

use App\Services\GPT\Enum\GptModelTypes;

it('word field should be required')->todo();
it('word field should has min 2 and max 20 characters')->todo();

it(
    'should send the prompt to the Completions open ai client',
    function (array $params) {

        config()->set('openai.model', GptModelTypes::DAVINCI->value);
        config()->set('openai.max_tokens', 70);
        config()->set('openai.temperature', 0.1);

        $responseMock = mountResponseMock(
            $params['word'],
            $params['qtd_sentences'],
        );

        mockCompletionsOpenAi($responseMock);
        authAs()->get("/generate?word={$params['word']}&qtd_sentences={$params['qtd_sentences']}&level={$params['level']}")
            ->assertOk()
            ->assertJson([
                'data' => explode('|', $responseMock),
            ]);

        openAiCompletionsAssertSent($params, 70, 0.1);
    }
)
    ->with('params_for_sentences')
    ->group('generate_controller');

it(
    'should send the prompt to the Chat open ai client',
    function (array $params) {

        config()->set('openai.model', GptModelTypes::GPT_3->value);
        config()->set('openai.max_tokens', 70);
        config()->set('openai.temperature', 0.1);

        $responseMock = mountResponseMock(
            $params['word'],
            $params['qtd_sentences'],
        );

        mockChatOpenAi($responseMock);
        authAs()->get("/generate?word={$params['word']}&qtd_sentences={$params['qtd_sentences']}&level={$params['level']}")
            ->assertOk()
            ->assertJson([
                'data' => explode('|', $responseMock),
            ]);

        openAiChatAssertSent($params, 70, 0.1);
    }
)
    ->with('params_for_sentences')
    ->group('generate_controller');
