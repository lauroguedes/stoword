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
use App\Services\GPT\Enum\GptModelTypes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use OpenAI\Resources\Completions;
use OpenAI\Resources\Chat;
use OpenAI\Responses\Chat\CreateResponse as ChatResponse;
use OpenAI\Responses\Completions\CreateResponse as CompletionsResponse;
use OpenAI\Testing\ClientFake;

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

function getJsonFormat(): string
{
    return json_encode([
        "word" => "",
        "ipa_word" => "",
        "translate" => "",
        "meaning" => [
            "value" => "",
            "translate" => ""
        ],
        "part_of_speech" => "",
        "plural" => "",
        "synonyms" => "",
        "word_forms" => "",
        "sentences" => [
            [
                "value" => "",
                "translate" => ""
            ]
        ]
    ]);
}

function authAs(?User $user = null): TestCase
{
    if (!$user) {
        $user = User::factory()->hasSetting()->create();

        return actingAs($user);
    }

    return actingAs($user);
}

function mockChatOpenAi(string $response = 'awesome!'): ClientFake
{
    return new ClientFake([
        ChatResponse::fake([
            'choices' => [
                [
                    'message' => ['content' => $response],
                ],
            ],
        ])
    ]);
}

function mockCompletionsOpenAi(string $response = 'awesome!'): ClientFake
{
    return new ClientFake([
        CompletionsResponse::fake([
            'choices' => [
                [
                    'text' => $response,
                ],
            ],
        ])
    ]);
}

function openAiCompletionsAssertSent(
    ClientFake $client,
    string $prompt,
    int $maxTokens,
    float $temperature
): void {
    $user = auth()->user();

    $content = sprintf(
        config('openai.system_completions_prompt'),
        $prompt,
        $user->setting->native_language,
        $user->setting->qtd_sentences,
        $user->setting->level,
        getJsonFormat()
    );

    $client->assertSent(
        Completions::class,
        function (string $method, array $parameters) use (
            $content,
            $maxTokens,
            $temperature
        ): bool {
            return $method === 'create' &&
                $parameters['model'] === GptModelTypes::DAVINCI->value &&
                $parameters['prompt'] === $content &&
                $parameters['max_tokens'] === $maxTokens &&
                $parameters['temperature'] === $temperature;
        }
    );
}

function openAiChatAssertSent(
    ClientFake $client,
    string $prompt,
    int $maxTokens,
    float $temperature
): void {
    $user = auth()->user();

    $systemContent = sprintf(
        config('openai.system_chat_prompt'),
        $user->setting->native_language,
        $user->setting->qtd_sentences,
        $user->setting->level,
        getJsonFormat()
    );

    $messages = [
        ['role' => 'system', 'content' => $systemContent],
        ['role' => 'user', 'content' => $prompt],
    ];

    $client->assertSent(
        Chat::class,
        function (string $method, array $parameters) use (
            $messages,
            $maxTokens,
            $temperature,
        ): bool {
            return $method === 'create' &&
                $parameters['model'] === GptModelTypes::GPT_3->value &&
                $parameters['messages'] === $messages &&
                $parameters['max_tokens'] === $maxTokens &&
                $parameters['temperature'] === $temperature;
        }
    );
}

function mountResponseMock(string $prompt): string
{
    $user = auth()->user();

    $sentences = [];

    for ($i = 0; $i < $user->setting->qtd_sentences; $i++) {
        $sentences[] = [
            'value' => fake()->sentence(4),
            'translate' => fake()->sentence(4),
        ];
    }

    return json_encode([
        "word" => $prompt,
        "ipa_word" => fake()->word(),
        "translate" => fake()->word(),
        "meaning" => [
            "value" => fake()->sentence(4),
            "translate" => fake()->sentence(4),
        ],
        "part_of_speech" => fake()->randomElement([
            'noun',
            'verb',
            'adjective',
            'adverb',
            'pronoun',
            'preposition',
            'conjunction',
            'interjection',
        ]),
        "plural" => str($prompt)->plural()->value(),
        "synonyms" => fake()->word() . ', ' . fake()->word(),
        "word_forms" => fake()->word() . ', ' . fake()->word(),
        "sentences" => $sentences,
    ]);
}
