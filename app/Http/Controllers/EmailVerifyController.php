<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailVerifyRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EmailVerifyController extends Controller
{
	public function index(): View
	{
		return view('auth.resetpassword.email-sent');
	}

	public function emailVerify(EmailVerifyRequest $request): RedirectResponse
	{
		$user = User::find($request->id);

		if (!$user->hasVerifiedEmail()) {
			$user->update([
				'is_email_verified' => 1,
			]);

			$user->markEmailAsVerified();
		}
		return redirect(route('login.index'));
	}

	public function verificationEmail(): View
	{
		return view('auth.resetpassword.email-sent');
	}
}
