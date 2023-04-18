<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\User;

class EmailVerifyRequest extends EmailVerificationRequest
{
	public function authorize()
	{
		$user = User::find($this->route('id'));

		if (!$user) {
			return false;
		}

		return hash_equals(sha1($user->getEmailForVerification()), (string) $this->route('hash'));
	}

	public function fulfill()
	{
		$user = User::find($this->route('id'));

		if (!$user->hasVerifiedEmail()) {
			$user->markEmailAsVerified();
		}
	}
}
