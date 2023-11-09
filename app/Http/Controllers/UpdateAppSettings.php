<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAppSettingsRequest;
use Illuminate\Http\Request;

class UpdateAppSettings extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateAppSettingsRequest $request)
    {
        $data = $request->validated();

        $request->user()->setting->level = $data['level'];
        $request->user()->setting->qtd_sentences = $data['qtd_sentences'];
        $request->user()->setting->native_language = $data['native_language'];

        $request->user()->setting->save();

        return back();
    }
}
