<?php

namespace App\Services\GPT\OpenAi;

use App\Services\DTOs\WordDto;
use Exception;
use Illuminate\Support\Facades\Validator;
use OpenAI\Contracts\ClientContract;
use Throwable;

abstract class OpenAiClient
{
    protected mixed $client;
    protected string $prompt;
    protected array $params;
    protected int $maxTokens;
    protected float $temperature;

    public function __construct(ClientContract $client)
    {
        $this->client = $client;
        $this->maxTokens = config('openai.max_tokens');
        $this->temperature = config('openai.temperature');
    }

    public function setPrompt(string $prompt): void
    {
        $this->prompt = $prompt;
    }

    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    public function setMaxTokens(int $maxTokens): void
    {
        $this->maxTokens = $maxTokens;
    }

    public function setTemperature(float $temperature): void
    {
        $this->temperature = $temperature;
    }

    public function getJsonFormat(): string
    {
        return json_encode([
            "word" => "",
            "ipa_word" => "",
            "translate" => "",
            "meaning" => [
                "value" => "",
                "translate" => ""
            ],
            "part_of_speech" => "",
            "plural" => "",
            "synonyms" => "",
            "word_forms" => "",
            "sentences" => [
                [
                    "value" => "",
                    "translate" => ""
                ]
            ]
        ]);
    }

    /**
     * @throws Throwable
     */
    protected function toArray(string $content): array
    {
        throw_if(
            !str()->of($content)->isJson(),
            new Exception('Response json invalid')
        );

        $content = json_decode($content, true);

        return WordDto::fromArray($content)->toArray();
    }

    protected abstract function mountParams(): array;
}
