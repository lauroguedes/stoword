<?php

use App\Http\Controllers\GenerateSentencesController;
use App\Http\Controllers\ProfileConfigController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'isAuth' => auth()->check(),
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/app', function () {
        return Inertia::render('App/Index');
    })->name('app');

    Route::get('/generate', GenerateSentencesController::class)->name('generate.sentences');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::put('/profile/config', [ProfileConfigController::class, 'update'])->name('profile.config.update');
});

require __DIR__ . '/auth.php';
