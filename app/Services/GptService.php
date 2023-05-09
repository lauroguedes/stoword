<?php

namespace App\Services;

use App\Http\Requests\GenerateSentencesRequest;

class GptService
{
    public function __construct(
        private Gpt $gptApi
    ) {
    }

    public function generate(array $params): array
    {
        $prompt = (new PromptParams(
            $params['qtd_sentences'],
            $params['level'],
            $params['word']
        )
        )->buildPrompt();

        $response = $this->gptApi
            ->setPrompt($prompt)
            ->setMaxTokens(70)
            ->generate();

        return explode('|', $response);
    }
}
