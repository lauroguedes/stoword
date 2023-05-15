<?php

use App\Services\GPT\PromptParams;

it('word field should be required')->todo();
it('word field should has min 2 and max 20 characters')->todo();

it(
    'should return the sentences with the word give according to params for completions model',
    function (int $qtdSentences, string $level, string $word) {
        $sentences = '';

        for ($i = 0; $i < $qtdSentences; $i++) {
            $sentences .= fake()->sentence(4) . " {$word}|";
        }

        $response = str()->replaceLast('|', '', $sentences);

        mockOpenAi($response);

        authAs()->get("/generate?qtd_sentences={$qtdSentences}&level={$level}&word={$word}")
            ->assertOk()
            ->assertJson([
                'data' => explode('|', $response),
            ]);

        $prompt = sprintf(
            config('openai.system_completions_prompt'),
            $qtdSentences,
            $level,
            $word,
        );

        openAiAssertSent(
            config('openai.completion_model'),
            $prompt
        );
    }
)->with([
    [3, 'A1', 'book'],
    [1, 'B2', 'hat'],
    [2, 'B2', 'pencil'],
])->skip('Testing chat model');


it('should return the sentences with the word give according to params for chat model', function (int $qtdSentences, string $level, string $word) {
    $sentences = '';

    for ($i = 0; $i < $qtdSentences; $i++) {
        $sentences .= fake()->sentence(4) . " {$word}|";
    }

    $response = str()->replaceLast('|', '', $sentences);

    mockOpenAi($response);

    authAs()->get("/generate?qtd_sentences={$qtdSentences}&level={$level}&word={$word}")
        ->assertOk()
        ->assertJson([
            'data' => explode('|', $response),
        ]);

    $prompt = [
        ['role' => 'system', 'content' => config('openai.system_chat_prompt')],
        ['role' => 'user', 'content' => "{$word}, {$qtdSentences}, {$level}"],
    ];

    openAiChatAssertSent(
        config('openai.chat_model'),
        $prompt
    );
})->with([
    [3, 'A1', 'book'],
    [1, 'B2', 'hat'],
    [2, 'B2', 'pencil'],
])->group('generate');
