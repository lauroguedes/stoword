<?php

namespace App\Providers;

use App\Services\TextToSpeach\TextToSpeachContract;
use App\Services\TextToSpeach\TextToSpeachType;
use App\Services\TextToSpeach\VoiceRss\VoiceRSS;
use App\Services\TextToSpeach\VoiceRss\VoiceRssAdapter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(VoiceRssAdapter::class, function ($app) {
            return new VoiceRssAdapter(new VoiceRSS());
        });

        $this->app->bind(TextToSpeachContract::class, function () {
            $adapter = TextToSpeachType::from(config('tts.service'))->getAdapter();

            return $this->app->make($adapter);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
    }
}
