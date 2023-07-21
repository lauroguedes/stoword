<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;

use function Pest\Laravel\post;

test('registration screen can be rendered')
    ->get('/register')
    ->assertOk();

test('new users can register', function () {
    post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'gpt_api_key' => fake()->numerify('sk-#######'),
    ])->assertRedirect(RouteServiceProvider::HOME);

    $this->assertAuthenticated();
});
