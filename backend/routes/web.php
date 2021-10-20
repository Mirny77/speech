<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Route::get('/',[\App\Http\Controllers\HistoryController::class,'index']);
Route::post('/history/delete/{id}',[\App\Http\Controllers\HistoryController::class,'delete'])->name('speech.delete');
Route::get('/speech',[\App\Http\Controllers\SpeechController::class,'show'])->name('speech.show');