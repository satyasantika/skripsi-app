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
Route::middleware(['auth','role:mahasiswa'])->group(function() {
    Route::get('/mahasiswa', App\Http\Controllers\Student\DasboardController::class)->name('mahasiswa.home');
    Route::resource('submission',App\Http\Controllers\Student\SubmissionController::class)->except('show');
    Route::resource('guidesubmission',App\Http\Controllers\Student\GuideSubmissionController::class)->except('show');
});
