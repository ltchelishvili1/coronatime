<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PasswordController;
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

Route::view('login', 'auth.login.index')->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::view('register', 'auth.signup.index')->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.post');
Route::view('register-verification-email-sent', 'auth.resetpassword.email-sent')->name('register.emailsent');
Route::get('register-email-verified/{token}', [RegisterController::class, 'emailVerify'])->name('register.emailverified');

Route::view('forgot-password', 'auth.resetpasswordreq.index')->name('password.resetrequest');
Route::post('forgot-password', [PasswordController::class, 'resetPassword'])->name('password.resetrequest.post');

Route::get('/reset-password/{token}', [PasswordController::class, 'index'])->name('password.resetform');
Route::post('/reset-password/{token}', [PasswordController::class, 'changePassword'])->name('password.update');
Route::view('/reset-password-changed', 'auth.resetpasswordreq.password-changed')->name('passwordchanged');

Route::view('/dashboard', 'dashboard.index')->name('dashboard');
Route::view('/dashboard-by-country', 'dashboard.bycountry')->name('dashboard.bycountry');
