<?php

namespace App\Http\Controllers\Actions\Word;

use App\Http\Controllers\Controller;
use App\Http\Resources\WordResource;
use App\Models\Word;

class ShowWordController extends Controller
{
    public function __invoke(Word $word)
    {
        return new WordResource($word);
    }
}
