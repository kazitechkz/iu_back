<?php

use App\Http\Controllers\Admin\AppealController as AdminAppealController;
use App\Http\Controllers\Admin\AppealTypeController as AdminAppealTypeController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\ForumController as AdminForumController;
use App\Http\Controllers\Admin\GroupController as AdminGroupController;
use App\Http\Controllers\Admin\LocaleController as AdminLocaleController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PermissionController as AdminPermissionController;
use App\Http\Controllers\Admin\PlanCombinationController as AdminPlanCombinationController;
use App\Http\Controllers\Admin\PlanController as AdminPlanController;
use App\Http\Controllers\Admin\PromocodeController as AdminPromocodeController;
use App\Http\Controllers\Admin\QuestionController as AdminQuestionController;
use App\Http\Controllers\Admin\RoleController as AdminRoleController;
use App\Http\Controllers\Admin\SingleSubjectTestController as AdminSingleSubjectTestController;
use App\Http\Controllers\Admin\SubjectContextController as AdminSubjectContextController;
use App\Http\Controllers\Admin\SubjectController as AdminSubjectController;
use App\Http\Controllers\Admin\SubscriptionController as AdminSubscriptionController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\WalletController as AdminWalletController;
use App\Http\Controllers\Admin\DiscussController as AdminDiscussController;
use App\Http\Controllers\Admin\TournamentController as AdminTournamentController;
use App\Http\Controllers\Admin\SubTournamentController as AdminSubTournamentController;
use App\Http\Controllers\Admin\SubTournamentParticipantController as AdminSubTournamentParticipantController;
use App\Http\Controllers\Admin\SubTournamentWinnerController as AdminSubTournamentWinnerController;
use App\Http\Controllers\Admin\SubTournamentResultController as AdminSubTournamentResultController;
use App\Http\Controllers\Admin\SubTournamentRivalController as AdminSubTournamentRivalController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\TestController as Testing;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin.dashboard');
})->name("home")->middleware("authenticate");
Route::get('/home', function () {
    return view('admin.dashboard');
})->name("home")->middleware("authenticate");
Route::get('login', function () {
    return view('auth.login');
})->name("login");
Route::get("/test",[TestController::class,"test"]);
Route::get("/test-answer",[TestController::class,"answerTest"]);
Route::get("/test-finish",[TestController::class,"finishTest"]);
Route::get("/test-subjects",[TestController::class,"subjectTest"]);

Route::group(["prefix" => "dashboard","middleware" => "auth"],function (){
    Route::resource("user",AdminUserController::class);
    Route::resource("role",AdminRoleController::class);
    Route::resource("locale",AdminLocaleController::class);
    Route::resource("permission",AdminPermissionController::class);
    Route::resource('subject', AdminSubjectController::class)->except(['show', 'destroy']);
    Route::resource('subject-contexts', AdminSubjectContextController::class)->except(['show', 'destroy']);
    Route::resource('single-tests', AdminSingleSubjectTestController::class)->except(['create', 'show', 'destroy']);
    Route::resource("plan",AdminPlanController::class);
    Route::resource('categories', AdminCategoryController::class)->except(['show', 'destroy']);
    Route::resource("plan-combination",AdminPlanCombinationController::class);
    Route::resource("subscription",AdminSubscriptionController::class);
    Route::resource("promocode",AdminPromocodeController::class);
    Route::resource("news",AdminNewsController::class);
    Route::resource("wallet",AdminWalletController::class);
    Route::resource("faq",AdminFaqController::class);
    Route::resource("questions",AdminQuestionController::class);
    Route::post('questions-ckeditor-upload', [AdminQuestionController::class, 'uploadFromCkeditor'])->name('questions-ckeditor-upload');
    Route::get('change-category-in-subject/{id}/{locale_id?}', [AdminQuestionController::class, 'changeCategoryInSubject'])->name('change-category-in-subject');
    Route::resource("group",AdminGroupController::class);
    Route::resource("appeal-type",AdminAppealTypeController::class);
    Route::resource("appeal",AdminAppealController::class);
    Route::resource("page",AdminPageController::class);
    Route::resource("forum",AdminForumController::class);
    Route::resource("discuss",AdminDiscussController::class);
    Route::resource("tournament",AdminTournamentController::class);
    Route::resource("sub-tournament",AdminSubTournamentController::class);
    Route::resource("sub-tournament-participant",AdminSubTournamentParticipantController::class);
    Route::resource("sub-tournament-winner",AdminSubTournamentWinnerController::class);
    Route::resource("sub-tournament-result",AdminSubTournamentResultController::class);
    Route::resource("sub-tournament-rival",AdminSubTournamentRivalController::class);



});


Route::get('import-db', [Testing::class, 'importDb']);
