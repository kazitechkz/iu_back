<?php

use App\Http\Controllers\Api\AuthController as ApiAuthController;
use App\Http\Controllers\Api\StepController as ApiStepController;
use App\Http\Controllers\Api\SubStepController as ApiSubStepController;
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
use App\Http\Controllers\Api\StatisticsController as ApiStatisticsController;
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
    Route::get('steps/{locale_id}', [ApiStepController::class, 'getSteps']);
    Route::get('step-detail/{id}', [ApiStepController::class, 'getStepDetail']);
    Route::get('sub-steps/{id}', [ApiSubStepController::class, 'getSubStepsByStepId']);
    Route::get('sub-step/{id}', [ApiSubStepController::class, 'getSubStepById']);
    Route::post('get-single-subject-test', [ApiQuestionController::class, 'getSingleSubjectTest']);
    Route::get('locales', [ApiLocaleController::class, 'index']);
    Route::get('faq', [ApiFaqController::class, 'index']);
    Route::get('forum', [ApiForumController::class, 'index']);
    Route::get("plan",[ApiPlanController::class,"index"]);
    Route::get("appeal-types",[ApiAppealTypeController::class,"index"]);

    Route::post('pass-step-test', [ApiStepController::class, 'passTest']);
    Route::get('get-step-tests/{sub_step_test_id}/{locale_id}', [ApiStepController::class, 'getStepTests']);
    Route::get('get-result-step-tests/{sub_step_id}/{locale_id}', [ApiStepController::class, 'getStepResultExam']);
    Route::post('check-sub-step-result', [ApiSubStepController::class, 'checkSubStepResultByUser']);
    //Get UNT Exam
    Route::post("/attempt",[AttemptController::class,"attempt"]);
    Route::get("/attempt_by/{id}",[AttemptController::class,"attemptById"]);
    Route::get("/user-attempts",[AttemptController::class,"userAttempts"]);
    Route::get("/user-unt-statistics",[AttemptController::class,"userUntStat"]);
    Route::get("/statistics-attempt-by/{id}",[AttemptController::class,"statAttemptById"]);
    Route::get("/finish/{attempt_id}",[AttemptController::class,"finish"]);
    Route::get("/save-question/{questionId}",[ApiQuestionController::class,"saveQuestion"]);
    Route::get("/get-fifty-fifty/{questionId}",[ApiQuestionController::class,"getFiftyFifty"]);
    Route::post("/create-appeal-question",[ApiQuestionController::class,"appealQuestion"]);
    //Check Answer
    Route::post("/answer",[AttemptController::class,"answer"]);
    Route::get("/answer-result/{attempt_subject_id}",[AttemptController::class,"answerResult"]);
    Route::post("/tournament-attempt",[ApiTournamentController::class,"attempt"]);
    Route::get("/tournaments-all",[ApiTournamentController::class,"getAllTournaments"]);
    Route::get("/tournament-detail/{id}",[ApiTournamentController::class,"tournamentDetail"]);
    Route::get("/sub-tournament-winners/{id}",[ApiTournamentController::class,"subTournamentWinners"]);
    Route::get("/sub-tournament-participants/{id}",[ApiTournamentController::class,"subTournamentParticipants"]);
    Route::get("/sub-tournament-results/{id}",[ApiTournamentController::class,"subTournamentResult"]);
    Route::get("/sub-tournament-rivals/{id}",[ApiTournamentController::class,"subTournamentRival"]);
    Route::get("/sub-tournament-detail/{id}",[ApiTournamentController::class,"subTournamentDetail"]);
    Route::post("/participate-tournament",[ApiTournamentController::class,"participate"]);
    //Statistics
    Route::get("/statistics/attempt-result/{attempt_id}",[ApiStatisticsController::class,"resultByAttemptId"]);
    Route::get("/statistics/attempt-stats/{attempt_id}",[ApiStatisticsController::class,"statsByAttemptId"]);
    Route::get("/statistics/subject-stats/{subject_id}",[ApiStatisticsController::class,"statsBySubjectId"]);




});
Route::post('/auth/login', [ApiAuthController::class, 'loginUser']);
Route::post("/auth/register",[ApiAuthController::class,"register"]);
Route::post("/auth/send-reset-token",[ApiAuthController::class,"sendResetToken"]);
Route::post("/auth/reset",[ApiAuthController::class,"resetPassword"]);
Route::get("/test",[\App\Http\Controllers\Api\TestController::class,"test"]);


//Plan
Route::get("/plan/unt",[ApiPlanController::class,"getUNTPlan"]);
Route::get("/plan/learning",[ApiPlanController::class,"getLearningPlan"]);

