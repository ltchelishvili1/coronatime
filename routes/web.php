<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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
// Route::redirect('/', 'dashboard')->middleware('auth');

Route::view('login', 'auth.login.index')->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::view('register', 'auth.signup.index')->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.store');

Route::view('reset-password-req', 'auth.resetpasswordreq.index')->name('resetpasswordreq');
Route::view('signup-email-verify', 'auth.signup.email-verify')->name('emailverify');
Route::view('signup-verification-email-sent', 'auth.resetpassword.email-sent')->name('signupverificationemail');
Route::get('signup-email-verified/{token}', [RegisterController::class, 'emailVerify'])->name('resetpasswordemailverified');

// Route::view('/reset-password-changed', 'auth.resetpasswordreq.password-changed')->name('passwordchanged');
// Route::view('/reset-password-recover', 'auth.resetpasswordreq.password-recover')->name('passwordrecover');

// Route::view('/reset-password', 'auth.resetpassword.index')->name('resetpasswordsuc');

// Route::view('/signup-email-verify', 'auth.signup.email-verify')->name('emailverify');

Route::view('/dashboard', 'dashboard.index')->name('dashboard');

Route::view('/dashboard-bycountry', 'dashboard.bycountry')->name('dashboard.bycountry');
