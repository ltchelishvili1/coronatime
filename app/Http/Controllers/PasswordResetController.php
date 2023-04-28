<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\ResetPassword;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PasswordResetController extends Controller
{
	public function index($token): View
	{
		return view('auth.resetpassword.index', ['token' => $token]);
	}

	public function resetPassword(ResetPasswordRequest $request): RedirectResponse
	{
		$email = ($request->validated()['email']);

		$token = Str::random(60);

		PasswordReset::create([
			'email'      => $email,
			'token'      => $token,
			'created_at' => now(),
		]);

		Mail::to($email)->send(new ResetPassword($token));
		return redirect(route('register.emailsent'));
	}

	public function changePassword(ChangePasswordRequest $request, $token): RedirectResponse
	{
		$newPassword = $request->validated()['new_password'];
		$email = PasswordReset::where('token', $token)->first()->email;

		User::where('email', $email)->update([
			'password' => bcrypt($newPassword),
		]);

		return redirect(route('passwordchanged'));
	}
}
