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
            $data = $request->validated();

            $result = $gpt->generate($data);

            return response()->json([
                'data' => $result
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return response()->json([
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
