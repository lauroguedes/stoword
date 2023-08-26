<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RunPHPArtisanController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return \Artisan::call('migrate', ['--force' => true]);
    }
}
