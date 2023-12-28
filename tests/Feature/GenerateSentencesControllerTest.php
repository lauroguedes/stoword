<?php

use App\Services\GPT\Enum\GptModelTypes;

it('word field should be required')->todo();
it('word field should has min 2 and max 20 characters')->todo();

it(
    'should send the prompt to the Completions open ai client',
    function () {
        config()->set('openai.model', GptModelTypes::DAVINCI->value);
        config()->set('openai.max_tokens', 70);
        config()->set('openai.temperature', 0.1);

        $prompt = 'go on';

        $responseMock = mountResponseMock($prompt);

        $client = mockCompletionsOpenAi($responseMock);

        authAs()->get('/generate?prompt=' . $prompt)
            ->assertOk()
            ->assertJson([
                'data' => $responseMock,
            ]);

        openAiCompletionsAssertSent($client, $prompt, 70, 0.1);
    }
)
    ->group('generate_controller')
    ->skip('should create a facade to GptService to can mock it');

it(
    'should send the prompt to the Chat open ai client',
    function () {
        config()->set('openai.model', GptModelTypes::GPT_3->value);
        config()->set('openai.max_tokens', 70);
        config()->set('openai.temperature', 0.1);

        $prompt = 'go on';

        $responseMock = mountResponseMock($prompt);

        $client = mockChatOpenAi($responseMock);

        authAs()->get('/generate?prompt=' . $prompt)
            ->assertOk()
            ->assertJson([
                'data' => $responseMock,
            ]);

        openAiChatAssertSent($client, $prompt, 70, 0.1);
    }
)
    ->group('generate_controller')
    ->skip('should create a facade to GptService to can mock it');
