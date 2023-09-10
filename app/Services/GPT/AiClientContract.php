<?php

namespace App\Services\GPT;

interface AiClientContract
{
    public function create(): array;
    public function createStream(): string;
}
