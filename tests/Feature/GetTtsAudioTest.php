<?php

use App\Http\Controllers\Actions\GetTtsAudio;
use App\Services\TextToSpeach\TextToSpeechContract;

beforeEach(function () {
    $this->tts = $this->mock(TextToSpeechContract::class);
});

test('it should return audio', function () {
    $source = 'Hello World';
    $data = [
        'error' => null,
        'response' => 'audio'
    ];

    $this->tts->shouldReceive('speech')
        ->with($source)
        ->andReturn($data);

    $request = new \Illuminate\Http\Request([
        'src' => $source
    ]);

    $controller = new GetTtsAudio($this->tts);

    $response = $controller($request);

    expect($response->getContent())
        ->toBe(json_encode($data))
        ->and($response->getStatusCode())
        ->toBe(200);
});

test('it should not return audio because source invalid', function () {
    $source = 'Hello World';
    $audio = 'audio';

    $this->tts->shouldReceive('speech')
        ->with($source)
        ->andReturn([
            'error' => null,
            'response' => $audio
        ]);

    $request = new \Illuminate\Http\Request([
        'src' => ''
    ]);

    $controller = new GetTtsAudio($this->tts);

    $response = $controller($request);

    expect($response->getContent())->toBe(json_encode([
        'error' => 'The src field is required.'
    ]));
});

test('it should not return audio because api invalid', function () {
    $source = 'Hello World';

    $this->tts->shouldReceive('speech')
        ->with($source)
        ->andThrow(new \Exception('API error'));

    $request = new \Illuminate\Http\Request([
        'src' => $source
    ]);

    $controller = new GetTtsAudio($this->tts);

    $response = $controller($request);

    expect($response->getContent())->toBe(json_encode([
        'error' => 'API error'
    ]));
});
