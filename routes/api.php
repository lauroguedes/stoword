<?php

use App\Http\Controllers\Actions\GetTtsAudio;
use App\Http\Controllers\Actions\SaveWordAndAttachUserController;
use App\Http\Controllers\WordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')
    ->post('words/save', SaveWordAndAttachUserController::class);

Route::get('tts/audio', GetTtsAudio::class);

Route::get('/words/history', [WordController::class, 'history'])
    ->middleware('auth:sanctum')
    ->name('words.history');

Route::apiResource('words', WordController::class)
    ->middleware('auth:sanctum');
