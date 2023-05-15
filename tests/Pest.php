<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Completions\CreateResponse as ResponseCompletions;
use OpenAI\Responses\Chat\CreateResponse as ResponseChat;
use OpenAI\Resources\Completions;
use OpenAI\Resources\Chat;

use function Pest\Laravel\{actingAs};

uses(
    Tests\TestCase::class,
    RefreshDatabase::class,
    WithFaker::class,
)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function authAs()
{
    $user = User::factory()->create();

    return actingAs($user);
}

function mockOpenAi(string $response = 'awesome!')
{
    OpenAI::fake([
        // ResponseCompletions::fake([
        //     'choices' => [
        //         [
        //             'text' => $response,
        //         ],
        //     ],
        // ]),
        ResponseChat::fake([
            'choices' => [
                [
                    'message' => ['content' => $response],
                ],
            ],
        ]),
    ]);
}

function openAiAssertSent($model, $prompt, $maxTokens = 0, $temperature = 0)
{
    OpenAI::assertSent(
        Completions::class,
        function (string $method, array $parameters) use (
            $model,
            $prompt
        ): bool {
            return $method === 'create' &&
                $parameters['model'] === $model &&
                $parameters['prompt'] === $prompt;
        }
    );
}

function openAiChatAssertSent($model, $prompt, $maxTokens = 0, $temperature = 0)
{
    OpenAI::assertSent(
        Chat::class,
        function (string $method, array $parameters) use (
            $model,
            $prompt
        ): bool {
            return $method === 'create' &&
                $parameters['model'] === $model &&
                $parameters['messages'] === $prompt;
        }
    );
}
