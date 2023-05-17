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
            throw_if(!GptModelTypes::tryFrom($modelType), new \ValueError('Invalid model expected'));

            $modelType = GptModelTypes::from($modelType);
        }

        $classInstance = app($modelType->getModelConcreteClass());

        throw_unless($classInstance instanceof AiClientContract, new \Exception('Invalid AI Client Service'));

        return $classInstance;
    }
}
