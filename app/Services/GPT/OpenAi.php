<?php

namespace App\Services\GPT;

use OpenAI\Laravel\Facades\OpenAI as FacadeOpenAi;

class OpenAi
{
    private string $prompt;
    private int $maxTokens;
    private float $temperature;

    public function __construct(
        private string $model,
        private string $systemPrompt,
    ) {
        $this->maxTokens = 0;
        $this->temperature = 0;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function setPrompt(string $prompt): void
    {
        $this->prompt = $prompt;
    }

    public function setSystemPrompt(string $systemPrompt): void
    {
        $this->systemPrompt = $systemPrompt;
    }

    public function setMaxTokens(int $maxTokens): void
    {
        $this->maxTokens = $maxTokens;
    }

    public function setTemperature(float $temperature): void
    {
        $this->temperature = $temperature;
    }

    public function completionsCreate(): string
    {
        $response = FacadeOpenAi::completions()
            ->create($this->getOptions());

        return $response['choices'][0]['text'];
    }

    private function getOptions(): array
    {
        $options = [
            'model' => $this->model,
            'prompt' => $this->systemPrompt
                ? "{$this->systemPrompt} {$this->prompt}"
                : $this->prompt,
        ];

        if ($this->maxTokens) {
            $options['max_tokens'] = $this->maxTokens;
        }

        if ($this->temperature) {
            $options['temperature'] = $this->temperature;
        }

        return $options;
    }
}
