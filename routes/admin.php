<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\ClassRegisterController;
use App\Http\Controllers\Admin\CommonApiController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SubjectCategoryController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('logout', [LoginController::class, 'logout'])->name('logout');
// Route::get('logout', [LoginController::class, 'logout']); // @Todo Remove logout GET method

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::group(['prefix'=>'','as'=>'','middleware' => ['admin.auth']], function(){
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name("dashboard");
    Route::get('/api/statistics/get-class-register-month', [DashboardController::class, 'getClassRegisterMonth']);
    Route::resource('contracts', ContractController::class);
    Route::resource('subject-categories', SubjectCategoryController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('classes', ClassController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('classes-register', ClassRegisterController::class);
    Route::resource('admins', AdminController::class);
    Route::get('api/admins', [AdminController::class, 'getData'])->name('admins.api');
    Route::get('api/classes-register', [ClassRegisterController::class, 'getData'])->name('classes-register.api');
    Route::post('api/classes-register/{id}/calendar', [ClassRegisterController::class, 'addCalendar'])->name('api.classes-register.calendar');
    Route::get('api/classes-register/{id}/filter/tutors', [ClassRegisterController::class, 'filterTutor'])->name('api.classes-register.filter');
    Route::post('api/classes-register/{id}/class/{user_id}/assign', [ClassRegisterController::class, 'assignClass'])->name('api.classes-register.assign');
    Route::delete('api/classes-register/calendar/{id}/delete', [ClassRegisterController::class, 'deleteCalendar'])->name('api.classes-register.calendar.delete');
    Route::get('api/classes-register/{id}/userAssigned', [ClassRegisterController::class, 'getUserAssignee'])->name('api.classes-register.userAssigned');
    Route::get('api/administrative-units', [CommonApiController::class, 'getAdministrativeUnits'])->name('api.administrative-units');
    Route::get('api/calendar/events/{modal_id}/get', [CommonApiController::class, 'getEvents'])->name('api.calendar.events');
    Route::get("profile", [AdminController::class, "profile"])->name("profile");
    Route::post("profile/store", [AdminController::class, "storeProfile"])->name("profile.store");
    Route::post("avatar/store", [AdminController::class, "storeAvatar"])->name("avatar.store");
    Route::get("security", [AdminController::class, "security"])->name("security");
    Route::post("security/store", [AdminController::class, "storeSecurity"])->name("security.store");
    Route::get("users", [UserController::class, "index"])->name("users.index");
    Route::POST("users/{id}/update/status", [UserController::class, "updateStatus"])->name("users.update.status");
    Route::POST("users/{id}/update/honnor", [UserController::class, "updateHonnor"])->name("users.update.honnor");
    Route::get("users/{id}/info", [UserController::class, "getInfoUsers"])->name("users.info");
    Route::get("api/users", [UserController::class, "getData"])->name("users.getData");
});
