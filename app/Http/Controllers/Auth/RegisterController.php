<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\verifyAccount;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
	public function register(RegisterRequest $request)
	{
		$validated = $request->validated();
		User::create($validated);

		$token = Str::random(64);
		Mail::to($validated['email'])->send(new verifyAccount($token));

		return redirect(route('signupverificationemail'));
	}

	public function emailVerify()
	{
		dd('done');
	}
}
