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
                native_language: 'pt-BR',
                qtd_sentences: 3,
                level: 'B2'
            )
            ->generate();
    }
}
