<?php

namespace App\Services\GPT\OpenAi;

use App\Services\GPT\AiClientContract;
use App\Services\GPT\Enum\GptModelTypes;
use OpenAI\Laravel\Facades\OpenAI as FacadeOpenAi;

class Completions extends OpenAiClient implements AiClientContract
{
    public function create(): string
    {
        $response = FacadeOpenAi::completions()
            ->create($this->mountParams());

        return $response['choices'][0]['text'];
    }

    public function createStream(): string
    {
        return '';
    }

    protected function mountParams(): array
    {
        $options = [
            'model' => GptModelTypes::DAVINCI,
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
