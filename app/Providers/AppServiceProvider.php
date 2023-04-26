<?php

namespace App\Providers;

use App\Services\GPT\OpenAi;
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
                config('openai.completion_model'),
                config('openai.system_prompt')
            );
        });

        $this->app->bind(OpenAiAdapter::class, function ($app) {
            return new OpenAiAdapter($app->make(OpenAi::class));
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
