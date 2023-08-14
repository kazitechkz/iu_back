<?php

use App\Http\Controllers\Admin\SubjectController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\UserController;
use \App\Http\Controllers\Admin\RoleController;
use \App\Http\Controllers\Admin\PermissionController;
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

    Route::resource("user",UserController::class);
    Route::resource("role",RoleController::class);
    Route::resource("permission",PermissionController::class);
    Route::resource('subject', SubjectController::class);

});
