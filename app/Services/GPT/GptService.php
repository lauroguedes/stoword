<?php

namespace App\Services\GPT;

use App\Jobs\SaveWordAndCreateHistoricJob;
use App\Models\User;
use App\Models\Word;
use App\Services\GPT\Adapters\AdapterAiClientContract;
use Illuminate\Support\Facades\Cache;
use Throwable;

class GptService
{
    private User $user;

    public function __construct(
        private readonly AdapterAiClientContract $gptApi
    ) {
        $this->user = auth()->user();
    }

    /**
     * @throws Throwable
     */
    public function generate(string $prompt): array
    {
        throw_if(
            !$data = $this->getResponse($prompt),
            new \Exception('Word data not found')
        );

        SaveWordAndCreateHistoricJob::dispatch($data, $this->user);

        $data['native_language'] = $this->user->setting->native_language;

        return $data;
    }

    private function getResponse(string $prompt): array
    {
        return Cache::remember(
            $prompt,
            now()->addDay(),
            function () use ($prompt) {
                return $this->getWordData($prompt) ?: [];
            }
        );
    }

    private function getWordData(string $prompt): array
    {
        $wordData = Word::whereName($prompt)->first();

        if (!$wordData) {
            return $this->gptApi->mountPrompt(
                prompt: $prompt,
                native_language: $this->user->setting->native_language,
                qtd_sentences: $this->user->setting->qtd_sentences,
                level: $this->user->setting->level,
            )->generate();
        }

        return $wordData->toArray();
    }
}
