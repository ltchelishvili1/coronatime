<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailVerifyRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class EmailVerifyController extends Controller
{
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
}
