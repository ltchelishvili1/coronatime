<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\verifyAccount;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RegisterController extends Controller
{
	public function register(RegisterRequest $request)
	{
		$validated = $request->validated();
		$validated['token'] = Str::random(64);
		Mail::to($validated['email'])->send(new verifyAccount($validated['token']));
		User::create($validated);

		return redirect(route('register.emailsent'));
	}

	public function emailVerify($token)
	{
		$user = User::where('token', $token)->first();

		if ($user) {
			$user->email_verified_at = Carbon::now();
			$user->save();
			return view('auth.resetpassword.email-verified');
		}
	}
}
