<?php

namespace App\Http\Controllers;

use App\Http\Requests\WordRequest;
use App\Http\Resources\WordResource;
use App\Models\Word;

class WordController extends Controller
{
    public function index()
    {
        return WordResource::collection(Word::all());
    }

    public function history()
    {
        $user = auth()->user();
        $words = $user->words
            ->take(6)
            ->sortByDesc('pivot.created_at');

        return WordResource::collection($words);
    }

    public function store(WordRequest $request)
    {
        return new WordResource(Word::create($request->validated()));
    }

    public function show(Word $word)
    {
        return new WordResource($word);
    }

    public function update(WordRequest $request, Word $word)
    {
        $word->update($request->validated());

        return new WordResource($word);
    }

    public function destroy(Word $word)
    {
        $word->delete();

        return response()->noContent();
    }
}
