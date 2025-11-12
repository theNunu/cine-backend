<?php

use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SeasonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ProgramController;

// Route::apiResource('programs', ProgramController::class);
Route::get('programs-movies', [ProgramController::class, 'getMovies']);
Route::get('/programs/count/{genre}', [ProgramController::class, 'countByGenre']);

Route::apiResource('programs', ProgramController::class);
Route::apiResource('seasons', SeasonController::class);
Route::apiResource('episodes', EpisodeController::class);