<?php

namespace App\Services;

use App\Services\GPT\OpenAi;

class OpenAiAdapter implements Gpt
{
    public function __construct(
        private OpenAi $openAi
    ) {
    }

    public function setModel(string $model): OpenAiAdapter
    {
        $this->openAi->setModel($model);

        return $this;
    }

    public function setSystemPrompt(string $systemPrompt): OpenAiAdapter
    {
        $this->openAi->setSystemPrompt($systemPrompt);

        return $this;
    }

    public function setPrompt(string $prompt): OpenAiAdapter
    {
        $this->openAi->setPrompt($prompt);

        return $this;
    }

    public function setMaxTokens(int $maxTokens): OpenAiAdapter
    {
        $this->openAi->setMaxTokens($maxTokens);

        return $this;
    }

    public function setTemperature(float $temperature): OpenAiAdapter
    {
        $this->openAi->setTemperature($temperature);

        return $this;
    }

    public function generate(): string|array
    {
        return $this->openAi->completionsCreate();
    }
}
