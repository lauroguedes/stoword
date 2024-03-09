<?php

namespace App\Http\Controllers\Actions\Word;

use App\Http\Controllers\Controller;
use App\Http\Requests\WordRequest;
use App\Http\Resources\WordResource;
use App\Models\Word;

class SaveWordController extends Controller
{
    public function __invoke(WordRequest $request)
    {
        return new WordResource(Word::create($request->validated()));
    }
}
