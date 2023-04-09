<?php

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

Route::view('/login', 'auth.login.index')->name('login');
Route::view('/signup', 'auth.signup.index')->name('signup');

Route::view('/reset-password-req', 'auth.resetpasswordreq.index')->name('resetpasswordreq');
Route::view('/reset-password-changed', 'auth.resetpasswordreq.password-changed')->name('passwordchanged');
Route::view('/reset-password-recover', 'auth.resetpasswordreq.password-recover')->name('passwordrecover');

Route::view('/reset-password', 'auth.resetpassword.index')->name('resetpasswordsuc');
Route::view('/reset-password-email-sent', 'auth.resetpassword.email-sent')->name('resetpasswordemailsent');

Route::view('/reset-password-email-verified', 'auth.resetpassword.email-verified')->name('resetpasswordemailverified');
Route::view('/signup-email-verify', 'auth.signup.email-verify')->name('emailverify');

Route::view('/dashboard', 'dashboard.index')->name('dashboard');
