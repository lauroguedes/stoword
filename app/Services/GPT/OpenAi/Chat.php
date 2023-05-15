<?php

namespace App\Services\GPT\OpenAi;

use App\Services\GPT\AiClientContract;

class Chat extends OpenAiClient implements AiClientContract
{
    public function create(): string
    {
        return '';
    }

    public function createStream(): string
    {
        return '';
    }

    protected function mountParams(): array
    {
        return [];
    }
}
