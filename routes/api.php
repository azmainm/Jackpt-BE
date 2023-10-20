<?php

use App\Http\Controllers\v1\AuthController;
use App\Http\Controllers\v1\IssueController;
use App\Http\Controllers\v1\MailController;
use App\Http\Controllers\v1\MailVerificationController;
use App\Http\Controllers\v1\OfferController;
use App\Http\Controllers\v1\PostController;
use App\Http\Controllers\v1\UserExistController;
use App\Http\Controllers\v1\UserProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['php.ini'], 'prefix' => 'v1', 'namespace' => 'v1'], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('user.login');
    Route::post('/register', [AuthController::class, 'register'])->name('user.register');
    Route::get('/user-exists', [UserExistController::class, 'checkUserExist']);
    Route::post('/send-sendMail', [MailController::class, 'sendRegisterMail']);
    Route::post('/forgot-password', [AuthController::class, 'checkForgotPassword']);
    Route::put('/reset-password', [AuthController::class, 'resetPassword']);
    Route::get('/verify-sendMail', [MailVerificationController::class, 'verifyEmail']);
});

Route::group(['middleware' => ['auth:api', 'php.ini'], 'prefix' => 'v1', 'namespace' => 'v1'], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh.token');
    Route::get('/user-profile', [UserProfileController::class, 'userProfile'])->name('user.profile');
});

Route::group(['middleware' => ['auth:api', 'php.ini'], 'prefix' => 'v1/posts'], function () {
    Route::get('/search', [PostController::class, 'search']);
    Route::get('', [PostController::class, 'index']);
    Route::post('', [PostController::class, 'store']);
    Route::get('/{id}', [PostController::class, 'show']);
    Route::put('{id}', [PostController::class, 'update']);
    Route::delete('{id}', [PostController::class, 'destroy']);
    Route::get('/search', [PostController::class, 'search']);

});

Route::group(['middleware' => ['auth:api', 'php.ini'], 'prefix' => 'v1/offers'], function () {
    Route::get('', [OfferController::class, 'view']);
    Route::post('', [OfferController::class, 'store']);
    Route::put('{id}', [OfferController::class, 'update']);
});

Route::group(['middleware' => ['auth:api', 'php.ini'], 'prefix' => 'v1/issues'], function () {
//    Route::get('', [IssueController::class, 'view']);
    Route::post('', [IssueController::class, 'store']);
});

//Route::group(['middleware' => ['auth:api', 'php.ini'], 'prefix' => 'v1/mails'], function () {
//    Route::post('',[\App\Http\Controllers\v1\SendMailController::class, 'sendMail']);
//});

Route::post('/mails',[\App\Http\Controllers\v1\SendMailController::class, 'sendMail']);

Route::post('/forgot-password',[\App\Http\Controllers\v1\PasswordResetController::class, 'forgotPassword']);
Route::put('/reset-password',[\App\Http\Controllers\v1\PasswordResetController::class, 'resetPassword']);
