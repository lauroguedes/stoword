<?php

namespace App\Services\GPT\Factories;

use App\Services\GPT\AiClientContract;
use App\Services\GPT\Enum\GptModelTypes;
use App\Services\GPT\Factories\GptFactoryContract;

class AiClientFactory implements GptFactoryContract
{
    public function factory(GptModelTypes|string $modelType): AiClientContract
    {
        if (is_string($modelType)) {
            $modelType = GptModelTypes::from($modelType);
        }

        $classInstance = app($modelType->getModelConcreteClass());

        abort_unless(
            $classInstance instanceof AiClientContract,
            400,
            'Invalid Ai Client Service'
        );

        return $classInstance;
    }
}
