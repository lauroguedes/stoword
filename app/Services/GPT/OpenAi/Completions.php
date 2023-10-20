<?php

namespace App\Services\GPT\OpenAi;

use App\Services\GPT\AiClientContract;
use App\Services\GPT\Enum\GptModelTypes;
use Throwable;

class Completions extends OpenAiClient implements AiClientContract
{
    /**
     * @throws Throwable
     */
    public function create(): array
    {
        $response = $this->client
            ->completions()
            ->create($this->mountParams());

        $content = $response->choices[0]->text;

        return $this->toArray($content);
    }

    public function createStream(): string
    {
        return '';
    }

    protected function mountParams(): array
    {
        $this->prompt = sprintf(
            config('openai.system_completions_prompt'),
            $this->params['prompt'],
            $this->params['native_language'],
            $this->params['qtd_sentences'],
            $this->params['level'],
            $this->getJsonFormat()
        );

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
