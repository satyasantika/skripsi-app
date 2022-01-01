<?php

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

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/changePassword',[App\Http\Controllers\Auth\ChangePasswordController::class, 'showChangePasswordGet'])->name('changePasswordGet');
    Route::post('/changePassword',[App\Http\Controllers\Auth\ChangePasswordController::class, 'changePasswordPost'])->name('changePasswordPost');
});
Route::middleware(['auth','role:student'])->group(function() {
    Route::get('/student', App\Http\Controllers\Student\DasboardController::class)->name('student.home');
    Route::resource('submission',App\Http\Controllers\Student\SubmissionController::class)->except('show');
    Route::get('guidesubmission/create{order}',[App\Http\Controllers\Student\GuideSubmissionController::class,'createGuideSubmission'])->name('guidesubmission.createGuideSubmission');
    Route::resource('guidesubmission',App\Http\Controllers\Student\GuideSubmissionController::class)->except(['show','create']);
    Route::resource('studentprofile',App\Http\Controllers\Student\ProfileController::class)->only(['edit','update']);
});
Route::middleware(['auth','role:lecture'])->group(function() {
    Route::get('/lecture', App\Http\Controllers\Lecture\DasboardController::class)->name('lecture.home');
    Route::resource('guidedecision',App\Http\Controllers\Lecture\GuideDecisionController::class)->only(['edit','update']);
});
Route::middleware(['auth','role:council'])->group(function() {
    Route::get('/council', App\Http\Controllers\Council\DasboardController::class)->name('council.home');
    Route::resource('guideallocation',App\Http\Controllers\Council\GuideAllocationController::class)->except('show');
    Route::resource('guidegroup',App\Http\Controllers\Council\GuideGroupController::class)->except('show');
    Route::get('/submissionlist',App\Http\Controllers\Council\GuideSubmissionController::class)->name('submissionlist.home');
    Route::get('/guideusage',App\Http\Controllers\Council\GuideUsageController::class)->name('guideallocation.usage');
});
Route::middleware(['auth','role:admin'])->group(function() {
    Route::get('/admin', App\Http\Controllers\Admin\DasboardController::class)->name('admin.home');
    Route::post('/user/role/assign/{user}',[App\Http\Controllers\Admin\UserController::class,'assignRole'])->name('user.role.assign');
    Route::post('/user/role/remove/{user}',[App\Http\Controllers\Admin\UserController::class,'removeRole'])->name('user.role.remove');
    Route::post('/user/search',[App\Http\Controllers\Admin\UserController::class,'search'])->name('user.search');
    Route::resource('user',App\Http\Controllers\Admin\UserController::class);
});
