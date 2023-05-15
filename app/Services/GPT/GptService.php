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
        $prompt = (new PromptParams(
            $params['qtd_sentences'],
            $params['level'],
            $params['word']
        )
        )->buildPrompt();

        /*
        * A cada 14 frases geradas a cota de 1k tokens
        * (Modelo Davinci) é atingida e será cobrado $0,12.
        */
        $response = $this->gptApi
            ->setPrompt($prompt)
            ->setMaxTokens(70)
            ->generate();

        return explode('|', $response);
    }
}
