<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\WordRequest;
use App\Models\Word;

class SaveWordAndAttachUserController extends Controller
{
    public function __invoke(WordRequest $request)
    {
        $word = Word::firstOrCreate(
            ['name' => $request->name],
            $request->validated()
        );

        if ($word->users->contains(auth()->id())) {
            return response()->noContent();
        }

        $word->users()->attach(auth()->id());

        return response()->json($word, 201);
    }
}
