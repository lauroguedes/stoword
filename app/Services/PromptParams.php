<?php

namespace App\Services;

class PromptParams
{
    public function __construct(
        private int $qtdSentences,
        private string $level,
        private string $word,
    ) {
    }

    public function buildPrompt(): string
    {
        return sprintf(
            config('openai.system_prompt'),
            $this->qtdSentences,
            $this->level,
            $this->word
        );
    }
}
