<?php

namespace App\Services\GPT\OpenAi;

use App\Services\GPT\AiClientContract;
use App\Services\GPT\Enum\GptModelTypes;
use Exception;
use Throwable;

class Chat extends OpenAiClient implements AiClientContract
{
    /**
     * @throws Throwable
     */
    public function create(): array
    {
        $response = $this->client
            ->chat()
            ->create($this->mountParams());

        $content = $response->choices[0]->message->content;

        return $this->toArray($content);
    }

    public function createStream(): string
    {
        return '';
    }

    protected function mountParams(): array
    {
        $systemPrompt = sprintf(
            config('openai.system_chat_prompt'),
            $this->params['native_language'],
            $this->params['qtd_sentences'],
            $this->params['level'],
            $this->getJsonFormat()
        );

        $this->prompt = $this->params['word'];

        $options = [
            'model' => GptModelTypes::GPT_3->value,
            'messages' => [
                ['role' => 'system', 'content' => $systemPrompt],
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
