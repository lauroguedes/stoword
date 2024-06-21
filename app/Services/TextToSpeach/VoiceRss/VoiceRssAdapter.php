<?php

namespace App\Services\TextToSpeach\VoiceRss;

use App\Services\TextToSpeach\TextToSpeechContract;

class VoiceRssAdapter implements TextToSpeechContract
{
    public function __construct(private readonly VoiceRSS $tts)
    {
    }

    /**
     * @throws \Throwable
     */
    public function speech(string $source): string|array
    {
        $data = $this->tts->speech([
            'ssl' => true,
            'key' => config('services.voice_rss.key'),
            'src' => $source,
            'v' => config('services.voice_rss.v'),
            'hl' => config('services.voice_rss.hl'),
            'r' => config('services.voice_rss.r'),
            'c' => config('services.voice_rss.c'),
            'f' => '44khz_16bit_stereo',
            'b64' => config('services.voice_rss.b64') ? 'true' : 'false'
        ]);

        throw_if($data['error'], new \Exception($data['error']));

        return $data['response'];
    }
}
