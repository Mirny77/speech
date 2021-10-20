<?php

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
Route::post('/test/microsoft',[\App\Http\Controllers\SpeechController::class,'microsoft']);
Route::post('/test',[\App\Http\Controllers\SpeechController::class,'index']);
Route::post('/yandex',[\App\Http\Controllers\YandexController::class,'index']);
Route::post('/yandex/check',[\App\Http\Controllers\YandexController::class,'check']);
Route::post('/cnt',[\App\Http\Controllers\CntController::class,'index']);
Route::post('/microsoft',[\App\Http\Controllers\MicrosoftController::class,'index']);

