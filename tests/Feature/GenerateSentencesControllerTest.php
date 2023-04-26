<?php

use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Resources\Completions;
use OpenAI\Responses\Completions\CreateResponse;

it('word field should be required')->todo();
it('word field should has min 2 and max 20 characters')->todo();

it('should return three sentences with the word or expression give', function (string $word) {
    $response = "\n\n1. First prompt with {$word}.\n2. Second prompt with {$word}.\n3. Third prompt with {$word}.";
    mockOpenAi($response);

    authAs()->get("/generate?word={$word}")
        ->assertOk()
        ->assertJson([
            'sentences' => $response,
        ]);

    openAiAssertSent(
        config('openai.completion_model'),
        config('openai.system_prompt') . ' ' . $word
    );
})->with(['book', 'hat'])
    ->group('generate');
