<?php

namespace App\Services\GPT\Adapters;

use App\Services\GPT\Adapters\AdapterAiClientContract;
use App\Services\GPT\OpenAi\Chat;
use App\Services\GPT\OpenAi\Completions;

class OpenAiAdapter implements AdapterAiClientContract
{
    public function __construct(
        private readonly Chat|Completions $openAi
    ) {
    }

    public function mountPrompt(...$arguments): static
    {
        $this->openAi->setParams($arguments);

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

    /**
     * @throws \Throwable
     */
    public function generate(): string|array
    {
        return $this->openAi->create();
    }
}
