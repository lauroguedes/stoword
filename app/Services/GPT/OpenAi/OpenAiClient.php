<?php

namespace App\Services\GPT\OpenAi;

use OpenAI\Contracts\ClientContract;

abstract class OpenAiClient
{
    protected mixed $client;
    protected string $prompt;
    protected int $maxTokens;
    protected float $temperature;

    public function __construct(ClientContract $client)
    {
        $this->client = $client;
        $this->maxTokens = config('openai.max_tokens');
        $this->temperature = config('openai.temperature');
    }

    public function setPrompt(string $prompt): void
    {
        $this->prompt = $prompt;
    }

    public function setMaxTokens(int $maxTokens): void
    {
        $this->maxTokens = $maxTokens;
    }

    public function setTemperature(float $temperature): void
    {
        $this->temperature = $temperature;
    }

    protected abstract function mountParams(): array;
}
