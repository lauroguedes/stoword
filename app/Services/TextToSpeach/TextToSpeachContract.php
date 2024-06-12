<?php

namespace App\Services\TextToSpeach;

interface TextToSpeachContract
{
    public function speach(string $source): string|array;
}
