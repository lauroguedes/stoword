<?php

namespace App\Services\GPT\OpenAi;

use App\Services\GPT\AiClientContract;
use App\Services\GPT\Enum\GptModelTypes;
use OpenAI\Laravel\Facades\OpenAI as FacadeOpenAi;

class Chat extends OpenAiClient implements AiClientContract
{
    public function create(): string
    {
        $response = FacadeOpenAi::chat()->create($this->mountParams());

        return $response->choices[0]->message->content;
    }

    public function createStream(): string
    {
        return '';
    }

    protected function mountParams(): array
    {
        $options = [
            'model' => GptModelTypes::GPT_3->value,
            'messages' => [
                ['role' => 'system', 'content' => config('openai.system_chat_prompt')],
                ['role' => 'user', 'content' => $this->prompt],
            ],
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
