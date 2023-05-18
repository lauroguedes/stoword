<?php

namespace App\Services\GPT;

use App\Services\GPT\Adapters\AdapterAiClientContract;

class GptService
{
    public function __construct(
        private AdapterAiClientContract $gptApi
    ) {
    }

    public function generate(array $params): array
    {
        $response = $this->gptApi
            ->mountPrompt($params['word'], $params['qtd_sentences'], $params['level'])
            ->generate();

        return is_array($response)
            ? $response
            : explode('|', $response);
    }
}
