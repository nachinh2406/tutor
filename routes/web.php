<?php

use App\Http\Controllers\Admin\CommonApiController;
use App\Http\Controllers\frontend\ClassRegisterController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserController;

use Illuminate\Support\Facades\Auth;
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


Route::get("/",[HomeController::class, "index"])->name("index");
Route::get("/contract",[HomeController::class, "contract"])->name("contract");
Route::get("/classes", [ClassRegisterController::class, "getListclasses"])->name("classes");
Route::get("/classes/{id}/detail", [ClassRegisterController::class, "detailClass"])->name("classes.detail");
Route::any("/contact", [HomeController::class, "pageContact"])->name("contact");


Route::group(['prefix'=>'','as'=>'','middleware' => ['auth']], function(){
Route::post("/classes/{idClass}/apply-class", [ClassRegisterController::class, "applyClass"])->name("class.apply");
Route::get("/profile",[UserController::class, "profile"])->name("profile.index");
Route::get("/profile/{idClass}/classes/contract",[UserController::class, "downloadContract"])->name("profile.contract.download");
Route::get("/profile/detail",[UserController::class, "detail"])->name("profile.detail");
Route::get("/profile/card",[UserController::class, "card"])->name("profile.card");
Route::get("/profile/class/recieve",[UserController::class, "recieveClass"])->name("profile.class.recieve");
Route::get("/profile/class/recieved",[UserController::class, "recievedClass"])->name("profile.class.recieved");
Route::any("/profile/password/change",[UserController::class, "changePassword"])->name("profile.password.change");
Route::get("/profile/calendar",[UserController::class, "calendar"])->name("profile.calendar");
Route::get("/profile/calendar/getEvents",[UserController::class, "getEventsCalendar"])->name("profile.calendar.getData");
Route::delete("/profile/calendar/{idcalendar}/delete",[UserController::class, "deleteEvent"])->name("profile.calendar.delete");
Route::post("/profile/calendar",[UserController::class, "updateCalendar"])->name("profile.calendar.update");
Route::post("/profile/avatar/store",[UserController::class, "storeAvatar"])->name("profile.avatar.store");
Route::any("/profile/comment",[UserController::class, "comment"])->name("profile.comment");
Route::post("/api/profile",[UserController::class, "updateProfile"])->name("profile.update");
Route::get('api/administrative-units', [CommonApiController::class, 'getAdministrativeUnits'])->name('api.administrative-units');
});
Auth::routes();

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
