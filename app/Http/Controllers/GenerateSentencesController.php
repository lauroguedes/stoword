<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateSentencesRequest;
use App\Services\GPT\GptService;

class GenerateSentencesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(GenerateSentencesRequest $request, GptService $gpt)
    {
        try {
            return response()->json([
                'data' => $gpt->generate($request->validated())
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
