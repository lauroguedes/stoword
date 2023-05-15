<?php

namespace App\Providers;

use App\Services\GPT\Adapters\AdapterAiClientContract;
use App\Services\GPT\Adapters\OpenAiAdapter;
use App\Services\GPT\GptService;
use App\Services\GPT\OpenAi\Completions;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AdapterAiClientContract::class, function ($app) {
            return new OpenAiAdapter($app->make(Completions::class));
        });

        $this->app->bind(GptService::class, function ($app) {
            return new GptService($app->make(AdapterAiClientContract::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
