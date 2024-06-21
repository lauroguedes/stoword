<?php

namespace App\Services\TextToSpeach;

use App\Services\TextToSpeach\VoiceRss\VoiceRssAdapter;

enum TextToSpeechType: string
{
    case VOICE_RSS = 'voice_rss';

    public function getAdapter(): string
    {
        return match ($this) {
            self::VOICE_RSS => VoiceRssAdapter::class,
        };
    }
}
