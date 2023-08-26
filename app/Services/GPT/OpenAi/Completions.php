<?php

namespace App\Services\GPT\OpenAi;

use App\Services\GPT\AiClientContract;
use App\Services\GPT\Enum\GptModelTypes;

class Completions extends OpenAiClient implements AiClientContract
{
    public function create(): array
    {
        $response = $this->client
            ->completions()
            ->create($this->mountParams());

        return explode('|', $response['choices'][0]['text']);
    }

    public function createStream(): string
    {
        return '';
    }

    protected function mountParams(): array
    {
        $options = [
            'model' => GptModelTypes::DAVINCI->value,
            'prompt' => $this->prompt,
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
