<?php

use App\Services\GPT\PromptParams;

it('word field should be required')->todo();
it('word field should has min 2 and max 20 characters')->todo();

it(
    'should return the sentences with the word or expression give according to params',
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

        $prompt = (new PromptParams(
            $qtdSentences,
            $level,
            $word
        ))->buildPrompt();

        openAiAssertSent(
            config('openai.completion_model'),
            $prompt
        );
    }
)->with([
    [3, 'A1', 'book'],
    [1, 'B2', 'hat'],
    [2, 'B2', 'pencil'],
])
    ->group('generate');
