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
Route::redirect('/', 'login')->middleware('guest');
Route::redirect('/', 'dashboard')->middleware('auth');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.post');
Route::get('register-verification-email-sent', [RegisterController::class, 'verificationEmail'])->name('register.emailsent');

Route::get('email/verify', [EmailVerifyController::class, 'index'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [EmailVerifyController::class, 'emailVerify'])->name('verification.verify');

Route::get('forgot-password', [PasswordResetController::class, 'resetRequest'])->name('password.resetrequest');
Route::post('reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.resetrequest.post');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'index'])->name('password.resetform');
Route::post('/reset-password/{token}', [PasswordResetController::class, 'changePassword'])->name('password.update');
Route::get('/reset-password-changed', [PasswordResetController::class, 'passwordchanged'])->name('passwordchanged');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard-by-country', [DashboardController::class, 'bycountry'])->name('dashboard.bycountry');

Route::get('set-language/{language}', [LanguageController::class, 'setLanguage'])->name('set-language');
