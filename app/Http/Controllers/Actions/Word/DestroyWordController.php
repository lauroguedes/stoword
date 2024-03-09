<?php

namespace App\Http\Controllers\Actions\Word;

use App\Http\Controllers\Controller;
use App\Models\Word;

class DestroyWordController extends Controller
{
    public function __invoke(Word $word)
    {
        $word->delete();

        return response()->json();
    }
}
