<?php

namespace App\Services\GPT\Adapters;

use App\Services\GPT\Adapters\AdapterAiClientContract;
use App\Services\GPT\OpenAi\Chat;
use App\Services\GPT\OpenAi\Completions;

class OpenAiAdapter implements AdapterAiClientContract
{
    public function __construct(
        private Chat|Completions $openAi
    ) {
    }

    public function setPrompt(string $prompt): static
    {
        $this->openAi->setPrompt($prompt);

        return $this;
    }

    public function setMaxTokens(int $maxTokens): static
    {
        $this->openAi->setMaxTokens($maxTokens);

        return $this;
    }

    public function setTemperature(float $temperature): static
    {
        $this->openAi->setTemperature($temperature);

        return $this;
    }

    public function generate(): string|array
    {
        return $this->openAi->create();
    }
}
