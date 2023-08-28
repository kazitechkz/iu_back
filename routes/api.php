<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NewsController as ApiNewsController;
use App\Http\Controllers\Api\LocaleController as ApiLocaleController;
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
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('subjects', [SubjectController::class, '']);
    Route::get("important-news",[ApiNewsController::class,"importantNews"]);
    Route::get("news",[ApiNewsController::class,"news"]);
    Route::get('subjects', [SubjectController::class, 'index']);
    Route::post('get-single-subject-test', [QuestionController::class, 'getSingleSubjectTest']);
    Route::get('locales', [ApiLocaleController::class, 'index']);
});
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::post("/auth/register",[AuthController::class,"register"]);

