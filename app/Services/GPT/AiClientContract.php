<?php

namespace App\Services\GPT;

interface AiClientContract
{
    public function create(): string;
    public function createStream(): string;
}
