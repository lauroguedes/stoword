<?php

namespace App\Providers;

use App\Services\GPT\Adapters\AdapterAiClientContract;
use App\Services\GPT\Adapters\OpenAiAdapter;
use App\Services\GPT\Factories\AiClientFactory;
use App\Services\GPT\GptService;
use App\Services\GPT\OpenAi\Chat;
use App\Services\GPT\OpenAi\Completions;
use Illuminate\Support\ServiceProvider;
use OpenAI;

class OpenAiClientServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Completions::class, function ($app) {
            $apiKey = auth()->user()->gpt_api_key ?? config('openai.api_key');
            $client = OpenAI::client($apiKey);

            return new Completions($client);
        });

        $this->app->singleton(Chat::class, function ($app) {
            $apiKey = auth()->user()->gpt_api_key ?? config('openai.api_key');
            $client = OpenAI::client($apiKey);

            return new Chat($client);
        });

        $this->app->bind(AdapterAiClientContract::class, function ($app) {
            $openAiClient = (new AiClientFactory())->factory(config('openai.model'));
            return new OpenAiAdapter($openAiClient);
        });

        $this->app->bind(GptService::class, function ($app) {
            return new GptService($app->make(AdapterAiClientContract::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
