<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateSentencesRequest;
use App\Services\OpenAiAdapter;

class GenerateSentencesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(GenerateSentencesRequest $request, OpenAiAdapter $openAi)
    {
        try {
            $result = $openAi
                ->setPrompt($request->word)
                ->setMaxTokens(70)
                ->generate();

            return response()->json([
                'sentences' => $result,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'sentences' => $th->getMessage(),
            ], 500);
        }
    }
}
