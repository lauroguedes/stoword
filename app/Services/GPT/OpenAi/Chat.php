<?php

namespace App\Services\GPT\OpenAi;

use App\Services\GPT\AiClientContract;
use App\Services\GPT\Enum\GptModelTypes;

class Chat extends OpenAiClient implements AiClientContract
{
    public function create(): array
    {
        $response = $this->client
            ->chat()
            ->create($this->mountParams());

        $content = $response->choices[0]->message->content;

        throw_if(
            !str()->of($content)->isJson(),
            new \Exception('Response json invalid')
        );

        return json_decode($content, true);
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
