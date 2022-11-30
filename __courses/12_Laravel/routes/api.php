<?php

use App\Http\Controllers\Api\EpisodesController;
use App\Http\Controllers\Api\SeasonsController;
use App\Http\Controllers\Api\SeriesController;
use App\Http\Controllers\UploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'series' => SeriesController::class,
]);

Route::get('/series/{series}/seasons', [SeasonsController::class, 'show']);

Route::apiResource('/upload', UploadController::class)
    ->only('store');

Route::get('/series/{series}/episodes', [EpisodesController::class, 'show']);

Route::patch('/episodes/{episode}/watched', [EpisodesController::class, 'update']);
