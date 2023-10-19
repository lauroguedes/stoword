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
        $user = auth()->user();

        return $this->gptApi
            ->mountPrompt(
                word: $params['word'],
                native_language: $user->setting->native_language,
                qtd_sentences: $user->setting->qtd_sentences,
                level: $user->setting->level,
            )
            ->generate();
    }
}
