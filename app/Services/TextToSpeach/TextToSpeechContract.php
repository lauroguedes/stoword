<?php

namespace App\Services\TextToSpeach;

interface TextToSpeechContract
{
    public function speech(string $source): string|array;
}
