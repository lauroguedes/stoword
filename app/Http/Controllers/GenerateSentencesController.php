<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateSentencesRequest;
use App\Services\GPT\GptService;
use Illuminate\Http\JsonResponse;
use Throwable;

class GenerateSentencesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(GenerateSentencesRequest $request, GptService $gpt): JsonResponse
    {
        try {
            return response()->json([
                'data' => $gpt->generate($request->validated()['prompt'])
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
