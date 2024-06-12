<?php

namespace App\Services\TextToSpeach\VoiceRss;

use App\Services\TextToSpeach\TextToSpeachContract;

class VoiceRssAdapter implements TextToSpeachContract
{
    public function __construct(private readonly VoiceRSS $tts)
    {
    }

    public function speach(string $source): string|array
    {
        return $this->tts->speech([
            'key' => config('services.voice_rss.key'),
            'src' => $source,
            'v' => config('services.voice_rss.v'),
            'hl' => config('services.voice_rss.hl'),
            'r' => config('services.voice_rss.r'),
            'c' => config('services.voice_rss.c'),
            'f' => '44khz_16bit_stereo',
            'ssml' => 'false',
            'b64' => config('services.voice_rss.b64'),
        ]);
    }
}
