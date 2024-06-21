<?php

use App\Services\TextToSpeach\VoiceRss\VoiceRSS;
use App\Services\TextToSpeach\VoiceRss\VoiceRssAdapter;

test('it should return audio', function (bool $b64) {
    config()->set('services.voice_rss.b64', $b64);

    $data = $b64
        ? [
            'error' => null,
            'response' => base64_encode('file')
        ]
        : [
            'error' => null,
            'response' => 'file'
        ];

    $voiceRss = mock(VoiceRSS::class)
        ->shouldReceive('speech')
        ->andReturn($data)
        ->getMock();

    $voiceRssAdapter = new VoiceRssAdapter($voiceRss);

    $audio = $voiceRssAdapter->speech('Hello World');

    expect($audio)->toBe($data['response']);
})
->with([
    'base_64_response' => true,
    'binary_response' => false,
]);
