<?php

namespace App\Providers;

use App\Services\GPT\OpenAi;
use App\Services\GptService;
use App\Services\OpenAiAdapter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(OpenAi::class, function () {
            return new OpenAi(
                config('openai.completion_model')
            );
        });

        $this->app->bind(OpenAiAdapter::class, function ($app) {
            return new OpenAiAdapter($app->make(OpenAi::class));
        });

        $this->app->bind(GptService::class, function ($app) {
            return new GptService($app->make(OpenAiAdapter::class));
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
