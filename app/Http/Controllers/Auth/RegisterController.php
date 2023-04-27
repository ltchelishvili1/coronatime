<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
	public function register(RegisterRequest $request)
	{
		$user = User::create($request->validated());
		$user->sendEmailVerificationNotification();
		return redirect(route('verification.notice'));
	}
}
