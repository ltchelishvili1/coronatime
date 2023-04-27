<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailVerifyController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PasswordResetController;
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

Route::middleware('guest')->group(function () {
	Route::redirect('/', 'login');
	Route::view('login', 'auth.login.index')->name('login.index');
	Route::view('register', 'auth.signup.index')->name('register.index');
	Route::view('email/verify', 'auth.resetpassword.email-sent')->name('verification.notice');
	Route::view('register-verification-email-sent', 'auth.resetpassword.email-sent')->name('register.emailsent');
	Route::view('reset-password-changed', 'auth.resetpasswordreq.password-changed')->name('passwordchanged');
	Route::view('forgot-password', 'auth.resetpasswordreq.index')->name('password.resetrequest');

	Route::post('login', [LoginController::class, 'login'])->name('login');
	Route::post('register', [RegisterController::class, 'register'])->name('register');

	Route::get('/email/verify/{id}/{hash}', [EmailVerifyController::class, 'emailVerify'])->name('verification.verify');
	Route::controller(PasswordResetController::class)->group(function () {
		Route::post('reset-password', 'resetPassword')->name('password.resetrequest.post');
		Route::get('reset-password/{token}', 'index')->name('password.resetform');
		Route::post('reset-password/{token}', 'changePassword')->name('password.update');
	});
});
Route::middleware(['verified', 'auth'])->group(function () {
	Route::redirect('/', 'dashboard');
	Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
	Route::get('dashboard-by-country', [DashboardController::class, 'bycountry'])->name('dashboard.bycountry');
	Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('set-language/{language}', [LanguageController::class, 'setLanguage'])->name('set-language');
