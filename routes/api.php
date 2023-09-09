<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StepController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NewsController as ApiNewsController;
use App\Http\Controllers\Api\LocaleController as ApiLocaleController;
use App\Http\Controllers\Api\FaqController as ApiFaqController;
use App\Http\Controllers\Api\ForumController as ApiForumController;
use App\Http\Controllers\Api\PlanController as ApiPlanController;
use App\Http\Controllers\Api\AppealTypeController as ApiAppealTypeController;
use App\Http\Controllers\Api\TournamentController as ApiTournamentController;
use App\Http\Controllers\Api\AttemptController;
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
    Route::get("important-news",[ApiNewsController::class,"importantNews"]);
    Route::get("news",[ApiNewsController::class,"news"]);
    Route::get('subjects', [SubjectController::class, 'index']);
    Route::post('get-single-subject-test', [QuestionController::class, 'getSingleSubjectTest']);
    Route::get('locales', [ApiLocaleController::class, 'index']);
    Route::get('faq', [ApiFaqController::class, 'index']);
    Route::get('forum', [ApiForumController::class, 'index']);
    Route::get("plan",[ApiPlanController::class,"index"]);
    Route::get("appeal-types",[ApiAppealTypeController::class,"index"]);

    Route::post('pass-step-test', [StepController::class, 'passTest']);
    Route::get('get-step-tests/{sub_step_id}/{locale_id}', [StepController::class, 'getStepTests']);
    //Get UNT Exam
    Route::post("/attempt",[AttemptController::class,"attempt"]);
    //Check Answer
    Route::post("/answer",[AttemptController::class,"answer"]);
    Route::post("/tournament-attempt",[ApiTournamentController::class,"attempt"]);
    Route::post("/participate",[ApiTournamentController::class,"participate"]);







});
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::post("/auth/register",[AuthController::class,"register"]);
Route::get("/test",[\App\Http\Controllers\Api\TestController::class,"test"]);

