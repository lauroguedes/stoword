<?php

namespace App\Services\GPT\Factories;

use App\Services\GPT\AiClientContract;
use App\Services\GPT\Enum\GptModelTypes;

interface GptFactoryContract
{
    public function factory(GptModelTypes|string $modelType): AiClientContract;
}
