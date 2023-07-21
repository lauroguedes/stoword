<?php

namespace App\Services\GPT\Enum;

use App\Services\GPT\OpenAi\Chat;
use App\Services\GPT\OpenAi\Completions;

enum GptModelTypes: string
{
    case GPT_3 = 'gpt-3.5-turbo';
    case DAVINCI = 'text-davinci-003';

    public function getModelConcreteClass(): string
    {
        return match ($this) {
            self::GPT_3 => Chat::class,
            self::DAVINCI => Completions::class,
        };
    }
}
