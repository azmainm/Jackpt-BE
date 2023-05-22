<?php

use App\Http\Controllers\ReportController;
use App\Http\Controllers\v1\AnnualWheelController;
use App\Http\Controllers\v1\AuthController;
use App\Http\Controllers\v1\CapTableController;
use App\Http\Controllers\v1\CapTableOwnerController;
use App\Http\Controllers\v1\CompanyInformationController;
use App\Http\Controllers\v1\CountryController;
use App\Http\Controllers\v1\EventController;
use App\Http\Controllers\v1\ExcelController;
use App\Http\Controllers\v1\InvitationController;
use App\Http\Controllers\v1\MailController;
use App\Http\Controllers\v1\MailVerificationController;
use App\Http\Controllers\v1\RecentCaptableController;
use App\Http\Controllers\v1\SubscriberController;
use App\Http\Controllers\v1\TransactionController;
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
    Route::post('/send-mail', [MailController::class, 'sendRegisterMail']);
    Route::post('/forgot-password', [AuthController::class, 'checkForgotPassword']);
    Route::put('/reset-password', [AuthController::class, 'resetPassword']);
    Route::get('/verify-mail', [MailVerificationController::class, 'verifyEmail']);
});

Route::group(['middleware' => ['auth:api', 'php.ini'], 'prefix' => 'v1', 'namespace' => 'v1'], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh.token');
    Route::get('/user-profile', [UserProfileController::class, 'userProfile'])->name('user.profile');
});
