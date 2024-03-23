<?php

namespace App\Services\GPT\OpenAi;

use Exception;
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

        return $this->dtoData($content);
    }

    private function dtoData(array $data): array
    {
        return [
            "name" => $data['word'] ?: null,
            "ipa" => $data['ipa_word'] ?: null,
            "translate" => $data['translate'] ?: null,
            "meaning" => [
                "value" => $data['meaning']['value'] ?: null,
                "translate" => $data['meaning']['translate'] ?: null
            ],
            "part_of_speech" => $data['part_of_speech'] ?: null,
            "plural" => $data['plural'] ?: null,
            "synonyms" => $data['synonyms'] ?: null,
            "forms" => $data['word_forms'] ?: null,
            "sentences" => $data['sentences'] ?: null
        ];
    }

    protected abstract function mountParams(): array;
}
