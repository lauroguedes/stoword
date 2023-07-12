<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileConfigUpdateRequest;
use Illuminate\Http\RedirectResponse;

class ProfileConfigController extends Controller
{
    public function update(ProfileConfigUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        $request->user()->save();

        return back();
    }
}
