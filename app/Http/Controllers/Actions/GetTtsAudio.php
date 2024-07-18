<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Services\TextToSpeach\TextToSpeechContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetTtsAudio extends Controller
{
    public function __construct(private readonly TextToSpeechContract $tts)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $source = $request->validate([
                'src' => 'required|string'
            ])['src'];

            $audio = $this->tts->speech($source);

            return response()->json($audio);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
