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
	Route::get('login', [LoginController::class, 'index'])->name('login');
	Route::post('login', [LoginController::class, 'login'])->name('login.post');
	Route::controller(RegisterController::class)->group(function () {
		Route::get('register', 'index')->name('register');
		Route::post('register', 'register')->name('register.post');
		Route::get('register-verification-email-sent', 'verificationEmail')->name('register.emailsent');
	});
	Route::get('email/verify', [EmailVerifyController::class, 'index'])->name('verification.notice');
	Route::get('/email/verify/{id}/{hash}', [EmailVerifyController::class, 'emailVerify'])->name('verification.verify');
	Route::controller(PasswordResetController::class)->group(function () {
		Route::get('forgot-password', 'resetRequest')->name('password.resetrequest');
		Route::post('reset-password', 'resetPassword')->name('password.resetrequest.post');
		Route::get('/reset-password/{token}', 'index')->name('password.resetform');
		Route::post('/reset-password/{token}', 'changePassword')->name('password.update');
		Route::get('/reset-password-changed', 'passwordchanged')->name('passwordchanged');
	});
});
Route::middleware('auth')->group(function () {
	Route::redirect('/', 'dashboard');
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	Route::get('/dashboard-by-country', [DashboardController::class, 'bycountry'])->name('dashboard.bycountry');
	Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('set-language/{language}', [LanguageController::class, 'setLanguage'])->name('set-language');
