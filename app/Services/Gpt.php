<?php

namespace App\Services;

interface Gpt
{
    public function generate(): string|array;
    public function setModel(string $model): Gpt;
    public function setPrompt(string $prompt): Gpt;
    public function setMaxTokens(int $maxTokens): Gpt;
    public function setTemperature(float $temperature): Gpt;
}
