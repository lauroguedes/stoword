<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateSentencesRequest;
use App\Services\GptService;

class GenerateSentencesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(GenerateSentencesRequest $request, GptService $gpt)
    {
        try {
            // $data = $request->validated();

            // $result = $gpt->generate($data);

            sleep(2);

            return response()->json([
                'data' => [
                    'I had a <span class="highlight">pencil</span> on my cabinet',
                    'The her <span class="highlight">pencil</span> was broken',
                    'He has a <span class="highlight">pencil</span> inside his case'
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
