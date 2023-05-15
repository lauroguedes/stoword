<?php

namespace App\Services\GPT\Adapters;

interface AdapterAiClientContract
{
    public function generate(): string|array;
    public function mountPrompt(string $word, int $qtdSentences, string $level): static;
    public function setMaxTokens(int $maxTokens): static;
    public function setTemperature(float $temperature): static;
}
