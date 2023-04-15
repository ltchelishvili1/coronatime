<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePassword;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\ResetPassword;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
	public function index($token)
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

	public function changePassword(ChangePassword $request, $token)
	{
		$newPassword = $request->validated()['new_password'];
		$email = PasswordReset::where('token', $token)->first()->email;

		User::where('email', $email)->update([
			'password' => bcrypt($newPassword),
		]);

		return redirect(route('passwordchanged'));
	}
}
