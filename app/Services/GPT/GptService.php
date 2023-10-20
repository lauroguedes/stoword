<?php

namespace App\Services\GPT;

use App\Services\GPT\Adapters\AdapterAiClientContract;

class GptService
{
    public function __construct(
        private readonly AdapterAiClientContract $gptApi
    ) {
    }

    public function generate(string $prompt): array
    {
        $user = auth()->user();

        return $this->gptApi
            ->mountPrompt(
                prompt: $prompt,
                native_language: $user->setting->native_language,
                qtd_sentences: $user->setting->qtd_sentences,
                level: $user->setting->level,
            )
            ->generate();
    }
}
