<?php

namespace App\Http\Controllers\Actions\Word;

use App\Http\Controllers\Controller;
use App\Http\Resources\WordResource;
use App\Models\Word;

class ListWordsController extends Controller
{
    public function __invoke()
    {
        return WordResource::collection(Word::all());
    }
}
