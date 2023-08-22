<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\QuestionController as AdminQuestionController;
use App\Http\Controllers\Admin\SingleSubjectTestController as AdminSingleSubjectTestController;
use App\Http\Controllers\Admin\SubjectController as AdminSubjectController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\UserController as AdminUserController;
use \App\Http\Controllers\Admin\RoleController as AdminRoleController;
use \App\Http\Controllers\Admin\PermissionController as AdminPermissionController;
use App\Http\Controllers\Admin\LocaleController as AdminLocaleController;
use App\Http\Controllers\Admin\PlanController as AdminPlanController;
use App\Http\Controllers\Admin\PlanCombinationController as AdminPlanCombinationController;
use App\Http\Controllers\Admin\SubscriptionController as AdminSubscriptionController;
use App\Http\Controllers\Admin\PromocodeController as AdminPromocodeController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\WalletController as AdminWalletController;
use App\Http\Controllers\Admin\GroupController as AdminGroupController;
use App\Http\Controllers\Admin\AppealTypeController as AdminAppealTypeController;
use App\Http\Controllers\Admin\AppealController as AdminAppealController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
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


Route::group(["prefix" => "dashboard","middleware" => "auth"],function (){
    Route::resource("user",AdminUserController::class);
    Route::resource("role",AdminRoleController::class);
    Route::resource("locale",AdminLocaleController::class);
    Route::resource("permission",AdminPermissionController::class);
    Route::resource('subject', AdminSubjectController::class)->except(['show', 'destroy']);
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
    Route::resource("group",AdminGroupController::class);
    Route::resource("appeal-type",AdminAppealTypeController::class);
    Route::resource("appeal",AdminAppealController::class);
    Route::resource("page",AdminPageController::class);
});
