<?php

it('profile configs can be updated', function () {
    $apiKey = 'sk-12345678';

    authAs()
        ->from('/profile')
        ->put('/profile/config', [
            'gpt_api_key' => $apiKey,
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    expect(auth()->user()->gpt_api_key)->toBe($apiKey);
});

it('profile config cannot updated because gpt key is invalid', function () {
    $apiKey = '12345678';

    authAs()
        ->from('/profile')
        ->put('/profile/config', [
            'gpt_api_key' => $apiKey,
        ])
        ->assertSessionHasErrors('gpt_api_key')
        ->assertRedirect('/profile');

    expect(auth()->user()->gpt_api_key)->not()->toBe($apiKey);
});
