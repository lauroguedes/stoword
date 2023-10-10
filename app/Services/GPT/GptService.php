<?php

namespace App\Services\GPT;

use App\Services\GPT\Adapters\AdapterAiClientContract;

class GptService
{
    public function __construct(
        private readonly AdapterAiClientContract $gptApi
    ) {
    }

    public function generate(array $params): array
    {
        return $this->gptApi
            ->mountPrompt(
                word: $params['word'],
                native_language: $params['native_language'],
                qtd_sentences: $params['qtd_sentences'],
                level: $params['level']
            )
            ->generate();
    }
}
