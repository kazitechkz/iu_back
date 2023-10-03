<?php

use App\Http\Controllers\Api\AuthController as ApiAuthController;
use App\Http\Controllers\Api\StepController as ApiStepController;
use App\Http\Controllers\Api\SubjectController as ApiSubjectController;
use App\Http\Controllers\Api\QuestionController as ApiQuestionController;
use App\Http\Controllers\Api\UserController as ApiUserController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group(['middleware' => 'API'], function() {
    Route::get('me', [ApiUserController::class, 'me']);
    Route::get("important-news",[ApiNewsController::class,"importantNews"]);
    Route::get("news",[ApiNewsController::class,"news"]);
    Route::get('subjects', [ApiSubjectController::class, 'index']);
    Route::get('steps', [ApiStepController::class, 'getSteps']);
    Route::get('step-detail/{id}', [ApiStepController::class, 'getStepDetail']);
    Route::post('get-single-subject-test', [ApiQuestionController::class, 'getSingleSubjectTest']);
    Route::get('locales', [ApiLocaleController::class, 'index']);
    Route::get('faq', [ApiFaqController::class, 'index']);
    Route::get('forum', [ApiForumController::class, 'index']);
    Route::get("plan",[ApiPlanController::class,"index"]);
    Route::get("appeal-types",[ApiAppealTypeController::class,"index"]);

    Route::post('pass-step-test', [ApiStepController::class, 'passTest']);
    Route::get('get-step-tests/{sub_step_id}/{locale_id}', [ApiStepController::class, 'getStepTests']);
    //Get UNT Exam
    Route::post("/attempt",[AttemptController::class,"attempt"]);
    Route::get("/attempt_by/{id}",[AttemptController::class,"attemptById"]);
    //Check Answer
    Route::post("/answer",[AttemptController::class,"answer"]);
    Route::post("/tournament-attempt",[ApiTournamentController::class,"attempt"]);
    Route::post("/participate",[ApiTournamentController::class,"participate"]);







});
Route::post('/auth/login', [ApiAuthController::class, 'loginUser']);
Route::post("/auth/register",[ApiAuthController::class,"register"]);
Route::post("/auth/send-reset-token",[ApiAuthController::class,"sendResetToken"]);
Route::post("/auth/reset",[ApiAuthController::class,"resetPassword"]);
Route::get("/test",[\App\Http\Controllers\Api\TestController::class,"test"]);

