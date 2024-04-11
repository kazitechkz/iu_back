<?php

use App\Http\Controllers\Api\AuthController as ApiAuthController;
use App\Http\Controllers\Api\CategoryController as ApiCategoryController;
use App\Http\Controllers\Api\FactController as ApiFactController;
use App\Http\Controllers\Api\OrderController as ApiOrderController;
use App\Http\Controllers\Api\PayboxController;
use App\Http\Controllers\Api\PromoCodeController as ApiPromoCodeController;
use App\Http\Controllers\Api\SubCategoryController as ApiSubCategoryController;
use App\Http\Controllers\Api\ClassroomController;
use App\Http\Controllers\Api\StepController as ApiStepController;
use App\Http\Controllers\Api\SubStepController as ApiSubStepController;
use App\Http\Controllers\Api\SubjectController as ApiSubjectController;
use App\Http\Controllers\Api\QuestionController as ApiQuestionController;
use App\Http\Controllers\Api\Teacher\ClassroomGroupController;
use App\Http\Controllers\Api\Teacher\DashboardController;
use App\Http\Controllers\Api\Teacher\ExamController;
use App\Http\Controllers\Api\Teacher\StudentController;
use App\Http\Controllers\Api\UserController as ApiUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NewsController as ApiNewsController;
use App\Http\Controllers\Api\LocaleController as ApiLocaleController;
use App\Http\Controllers\Api\FaqController as ApiFaqController;
use App\Http\Controllers\Api\ForumController as ApiForumController;
use App\Http\Controllers\Api\PlanController as ApiPlanController;
use App\Http\Controllers\Api\WalletController as ApiWalletController;
use App\Http\Controllers\Api\AppealTypeController as ApiAppealTypeController;
use App\Http\Controllers\Api\TournamentController as ApiTournamentController;
use App\Http\Controllers\Api\StatisticsController as ApiStatisticsController;
use App\Http\Controllers\Api\NotificationController as ApiNotificationController;
use App\Http\Controllers\Api\AnnouncementController as ApiAnnouncementController;
use App\Http\Controllers\Api\TechSupportController as ApiTechSupportController;
use App\Http\Controllers\Api\BattleController as ApiBattleController;
use App\Http\Controllers\Api\AttemptController;
use App\Http\Controllers\Api\AttemptSettingsController as ApiAttemptSettingsController;
use App\Http\Controllers\Api\CareerController as ApiCareerController;
use App\Http\Controllers\Api\IUTubeController as ApiIUTubeController;
use App\Http\Controllers\Api\OpenAiController as ApiOpenAiController;
use App\Http\Controllers\Api\InformationController as ApiInformationController;
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
if(env("IS_API",true)){
    Route::group(["middleware" => "auth:sanctum"],function (){
        Route::group(['middleware' => 'API'], function() {
            Route::get('me', [ApiUserController::class, 'me']);
            Route::post('change-profile', [ApiUserController::class, 'changeProfile']);
            Route::post('change-avatar', [ApiUserController::class, 'changeAvatar']);
            Route::get("important-news",[ApiNewsController::class,"importantNews"]);
            Route::get("single-news/{id}",[ApiNewsController::class,"singleNews"]);
            Route::get("all-news",[ApiNewsController::class,"news"]);
            Route::get('subjects', [ApiSubjectController::class, 'index']);
            Route::get('subjects-without-required', [ApiSubjectController::class, 'getSubjectsWithoutRequired']);
            Route::get('get-my-subjects', [ApiSubjectController::class, 'getMySubjects']);
            Route::get('categories/{id}/{locale_id}', [ApiCategoryController::class, 'getCategoriesBySubjectID']);
            Route::get('sub-categories/{id}/{locale_id}', [ApiSubCategoryController::class, 'getSubCategoriesByCategoryID']);
            Route::get('steps/{locale_id}', [ApiStepController::class, 'getSteps']);
            Route::get('step-detail/{id}', [ApiStepController::class, 'getStepDetail']);
            Route::get('sub-steps/{id}', [ApiSubStepController::class, 'getSubStepsByStepId']);
            Route::get('sub-step/{id}', [ApiSubStepController::class, 'getSubStepById']);
            Route::post('findSubStepBySubCategoryId', [ApiSubStepController::class, 'getSubStepBySubCategoryId']);
            Route::get('facts/{subject_id}', [ApiFactController::class, 'getFactsBySubjectID']);

            Route::get('locales', [ApiLocaleController::class, 'index']);
            Route::get('faq', [ApiFaqController::class, 'index']);
            Route::get('forum', [ApiForumController::class, 'index']);
            Route::get("plan",[ApiPlanController::class,"index"]);
            Route::get("appeal-types",[ApiAppealTypeController::class,"index"]);

            Route::post('pass-step-test', [ApiStepController::class, 'passTest']);
            Route::get('get-step-tests/{sub_step_test_id}/{locale_id}', [ApiStepController::class, 'getStepTests']);
            Route::get('get-result-step-tests/{sub_step_id}/{locale_id}', [ApiStepController::class, 'getStepResultExam']);
            Route::post('check-sub-step-result', [ApiSubStepController::class, 'checkSubStepResultByUser']);
            Route::post('get-step-by-forum', [ApiSubStepController::class, 'checkSubStepResultByUser']);
            //Get UNT Exam
            Route::post("/attempt",[AttemptController::class,"attempt"]);
            Route::get("/attempt-types",[AttemptController::class,"attemptTypes"]);
            Route::get("/attempt_by/{id}",[AttemptController::class,"attemptById"]);
            Route::post("/create-attempt-settings",[AttemptController::class,"createAttemptSettings"]);
            Route::post("/create-attempt-settings-unt",[AttemptController::class,"createAttemptSettingsUNT"]);
            Route::get("/attempt-by-promo-code/{promo_code}",[AttemptController::class,"attemptByPromoCode"]);
            Route::get("/user-attempts",[AttemptController::class,"userAttempts"]);
            Route::get("/user-unt-statistics",[AttemptController::class,"userUntStat"]);
            Route::get("/statistics-attempt-by/{id}",[AttemptController::class,"statAttemptById"]);
            Route::get("/finish/{attempt_id}",[AttemptController::class,"finish"]);
            //AttemptSettings
            Route::get("/my-attempt-settings-single",[ApiAttemptSettingsController::class ,"myAttemptSettingsSingle"]);
            Route::get("/my-attempt-settings-unt",[ApiAttemptSettingsController::class ,"myAttemptSettingsUNT"]);

            //AttemptSettings
            //Question
            Route::post('get-single-subject-test', [ApiQuestionController::class, 'getSingleSubjectTest']);
            Route::get("/save-question/{questionId}",[ApiQuestionController::class,"saveQuestion"]);
            Route::get("/get-fifty-fifty/{questionId}",[ApiQuestionController::class,"getFiftyFifty"]);
            Route::post("/create-appeal-question",[ApiQuestionController::class,"appealQuestion"]);
            Route::post("/get-sub-category-question-count",[ApiQuestionController::class,"getSubCategoryQuestion"]);
            Route::post("/get-category-question-count",[ApiQuestionController::class,"getCategoryQuestion"]);
            Route::get("/my-saved-questions",[ApiQuestionController::class,"getMySavedQuestion"]);
            Route::get("/my-appeals-questions",[ApiQuestionController::class,"getMyAppealQuestion"]);
            Route::get("/my-appeal-question-by/{appealId}",[ApiQuestionController::class,"getAppealedQuestion"]);
            Route::get("/my-saved-question-by/{questionId}",[ApiQuestionController::class,"getSavedQuestionById"]);
            //Question
            //Check Answer
            Route::post("/answer",[AttemptController::class,"answer"]);
            Route::get("/answer-result/{attempt_subject_id}",[AttemptController::class,"answerResult"]);
            Route::post("/tournament-attempt",[ApiTournamentController::class,"attempt"]);
            Route::get("/tournaments-all",[ApiTournamentController::class,"getAllTournaments"]);
            Route::get("/tournaments-list",[ApiTournamentController::class,"tournamentList"]);
            Route::get("/tournament-detail/{id}",[ApiTournamentController::class,"tournamentDetail"]);
            Route::get("/tournament-awards/{id}",[ApiTournamentController::class,"tournamentAward"]);
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
            Route::get("/statistics/full-stats",[ApiStatisticsController::class,"fullStatistics"]);
            //Plan
            Route::get("/plan/unt",[ApiPlanController::class,"getUNTPlan"]);
            Route::get("/plan/learning",[ApiPlanController::class,"getLearningPlan"]);
            Route::get("/plan/check-unt-plan",[ApiPlanController::class,"checkPlanUNT"]);
            //Forum
            Route::post("/forum/create",[ApiForumController::class,"createForum"]);
            Route::get("/forum/index",[ApiForumController::class,"index"]);
            Route::post("/forum/rating",[ApiForumController::class,"ratingForumOrDiscuss"]);
            Route::get("/forum/show/{id}",[ApiForumController::class,"show"]);
            Route::get("/forum/discuss/{forum_id}",[ApiForumController::class,"forumDiscuss"]);
            Route::post("/discuss/create",[ApiForumController::class,"createDiscuss"]);
            //Wallet
            Route::get("/wallet",[ApiWalletController::class,"index"]);
            Route::get("/wallet-rating",[ApiWalletController::class,"getAllWalletRating"]);
            Route::get("/my-balance",[ApiWalletController::class,"myBalance"]);
            Route::get("/my-wallet",[ApiWalletController::class,"myWallet"]);
            Route::post("/wallet-transfer",[ApiWalletController::class,"transfer"]);
            Route::get("/my-wallet-transaction",[ApiWalletController::class,"myTransaction"]);
            //User
            Route::post("/find-user-by-email",[ApiUserController::class,"userEmail"]);
            //User
            //Notification
            Route::get("/notification/unread-count",[ApiNotificationController::class,"getNewMessageCount"]);
            Route::get("/notification/all",[ApiNotificationController::class,"getNotifications"]);
            Route::get("/notification/my-notification-ids",[ApiNotificationController::class,"getUserReadMessagesIds"]);
            Route::get("/notification/check-notification/{id}",[ApiNotificationController::class,"checkNotification"]);
            Route::get("/notification/notification-types",[ApiNotificationController::class,"getNotificationTypes"]);
            //Notification
            //Announcement
            Route::get("/announcement",[ApiAnnouncementController::class,"index"]);
            //Announcement
            //Tech Support Type
            Route::get("/tech-support-types",[ApiTechSupportController::class,"getTechSupportTypes"]);
            Route::get("/tech-support-categories",[ApiTechSupportController::class,"getTechSupportCategories"]);
            Route::get("/my-tech-support-tickets",[ApiTechSupportController::class,"myTechSupportTickets"]);
            Route::get("/get-tech-support-ticket-detail/{id}",[ApiTechSupportController::class,"getTicketById"]);
            Route::post("/tech-support-create-ticket",[ApiTechSupportController::class,"createTechSupportTickets"]);
            Route::post("/tech-support-close-ticket",[ApiTechSupportController::class,"closeTechSupportTickets"]);
            Route::post("/tech-support-create-message",[ApiTechSupportController::class,"createTechSupportMessage"]);
            //Tech Support Type
            //Battle
            Route::get("/battles",[ApiBattleController::class,"getActiveBattles"]);
            Route::get("/my-active-battles",[ApiBattleController::class,"getMyActiveBattles"]);
            Route::get("/battle/{promo_code}",[ApiBattleController::class,"getBattleByPromo"]);
            Route::get("/battle-questions/{promo_code}",[ApiBattleController::class,"getBattleQuestionsByPromo"]);
            Route::post("/battle-create",[ApiBattleController::class,"createBattle"]);
            Route::post("/battle-step-create",[ApiBattleController::class,"createBattleStep"]);
            Route::get("/battle-subjects/{battle_step_id}",[ApiBattleController::class,"proposeSubjects"]);
            Route::get("/battle-by-step/{battle_step_id}",[ApiBattleController::class,"getBattleStepById"]);
            Route::post("/battle-by-step-answer",[ApiBattleController::class,"answerQuestion"]);
            Route::get("/battle-finish-result/{battle_step_id}",[ApiBattleController::class,"finishBattleResult"]);
            Route::post("/join-to-battle-by-promo-code",[ApiBattleController::class,"joinToBattleByPromoCode"]);
            Route::get("/battle-history",[ApiBattleController::class,"battleHistory"]);
            Route::get("/battle-stats",[ApiBattleController::class,"battleStats"]);
            //Battle

            //Forum
            Route::post("/upload-image",[\App\Http\Controllers\Api\FileUploadController::class,"uploadImage"]);
            Route::resource('classrooms', ClassroomController::class)->only(['index', 'show', 'destroy', 'store']);
            //Career
            Route::get("/career-quizzes",[ApiCareerController::class,"careerQuizzes"]);
            Route::get("/career-quiz-detail/{id}",[ApiCareerController::class,"careerQuizDetail"]);
            Route::get("/pass-career-quiz/{id}",[ApiCareerController::class,"passCareerQuiz"]);
            Route::post("/finish-career-quiz",[ApiCareerController::class,"finishCareerQuiz"]);
            Route::get("/result-career-quiz/{id}",[ApiCareerController::class,"resultCareerQuiz"]);
            Route::get("/career-quiz-groups-list",[ApiCareerController::class,"careerQuizGroupList"]);
            Route::get("/my-career-attempts",[ApiCareerController::class,"myCareerAttempts"]);
            //IUTube
            Route::get("/main-videos",[ApiIUTubeController::class,"getMainVideos"]);
            Route::get("/all-videos",[ApiIUTubeController::class,"getListVideos"]);
            Route::get("/video-author-detail/{id}",[ApiIUTubeController::class,"getAuthorDetail"]);
            Route::get("/video-detail/{alias}",[ApiIUTubeController::class,"getSingleVideo"]);
            //ORDERS
            Route::get('my-orders', [ApiOrderController::class, 'getAll']);
            //OPEN API
            Route::get("/get-ai-answer/{questionId}",[ApiOpenAiController::class,"getOpenAiAnswer"]);

            //TEACHER_ROUTES
            Route::prefix('teacher')->name('teacher.')->group(function () {
                Route::get('dashboard', [DashboardController::class, 'index']);
                Route::post('get-stats-by-subject', [DashboardController::class, 'getStatsBySubjectID']);
                Route::post('get-stats-by-unt', [DashboardController::class, 'getStatsByUNT']);
                Route::get('get-own-students', [StudentController::class, 'getOwnStudents']);
                Route::get('get-stats-by-user/{id}', [StudentController::class, 'getStats']);
                Route::resource('classrooms', ClassroomGroupController::class);
                Route::get('detail-classroom/{id}', [ClassroomGroupController::class, 'getDetailClassroom']);
                Route::delete('detail-classroom/{classroom_id}', [ClassroomGroupController::class, 'deleteUserFromClass']);
                Route::get("/my-attempt-settings",[AttemptController::class,"myAttemptSettings"]);
                Route::get("/my-attempt-settings-unt",[AttemptController::class,"myAttemptSettingsUNT"]);
                Route::delete("/delete-attempt-settings/{id}",[AttemptController::class,"deleteAttemptSettingsById"]);
                Route::delete("/delete-attempt-settings-unt/{id}",[AttemptController::class,"deleteAttemptSettingsUNTById"]);
                Route::post('get-subjects-array-by-user-ids', [ClassroomGroupController::class, 'getSubjectsArrayByUserIDS']);
                Route::get('get-single-test-statistics/{id}', [ExamController::class, 'getSingleTestByID']);
                Route::get('get-unt-test-statistics/{id}', [ExamController::class, 'getUNTTestByID']);
                Route::get('statistics/attempt-stats/{attempt_id}/{user_id}', [ExamController::class, 'statsByAttemptId']);
            });

            Route::post('check-promo', [ApiPromoCodeController::class, 'checkPromo']);
        });
    });
//Forum
    Route::post("/upload-image",[\App\Http\Controllers\Api\FileUploadController::class,"uploadImage"])->middleware("API");
    Route::post('/auth/login', [ApiAuthController::class, 'loginUser']);
    Route::post('/auth/kundelik', [ApiAuthController::class, 'loginUserFromKundelik']);
    Route::post("/auth/register",[ApiAuthController::class,"register"]);
    Route::post("/auth/verify-email",[ApiAuthController::class,"verifyEmail"]);
    Route::post("/auth/send-reset-token",[ApiAuthController::class,"sendResetToken"]);
    Route::post("/auth/reset",[ApiAuthController::class,"resetPassword"]);
    Route::get("/auth/user-check",[ApiAuthController::class,"userCheck"]);
    Route::get("/test",[\App\Http\Controllers\Api\TestController::class,"test"]);
    Route::post("/send-whatsapp",[\App\Http\Controllers\Api\TestController::class,"sendWhatsapp"]);

    Route::post("/paybox",[PayboxController::class,"paybox"]);
    Route::post("/pay/result",[PayboxController::class,"payboxResultURL"]);
    Route::post("/pay/success",[PayboxController::class,"payboxSuccessURL"]);
    Route::post("/pay/failure",[PayboxController::class,"payboxFailureURL"]);

    Route::post("/pay-career",[PayboxController::class,"payCareer"]);
    Route::post("/pay/career-result",[PayboxController::class,"payboxCareerResultURL"]);
    Route::post("/pay/career-success",[PayboxController::class,"payboxCareerSuccessURL"]);
    Route::post("/pay/career-failure",[PayboxController::class,"payboxCareerFailureURL"]);

    Route::post("/pay-tournament",[PayboxController::class,"payTournament"]);
    Route::post("/pay/tournament-result",[PayboxController::class,"payTournamentResultURL"]);
    Route::post("/pay/tournament-success",[PayboxController::class,"payTournamentSuccessURL"]);
    Route::post("/pay/tournament-failure",[PayboxController::class,"payTournamentFailureURL"]);
    //Information
    Route::get("/hottest-information",[ApiInformationController::class,"getMainNews"]);
    Route::get("/information",[ApiInformationController::class,"getMainNews"]);
}
else{
    Route::get("/",function (){
       return "IT WORKS!";
    });
}






