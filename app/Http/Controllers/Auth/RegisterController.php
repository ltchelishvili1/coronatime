<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;

class RegisterController extends Controller
{
	public function index(): View
	{
		return view('auth.signup.index');
	}

	public function register(RegisterRequest $request)
	{
		$validated = $request->validated();
		$user = User::create($validated);
		$user->sendEmailVerificationNotification();
		return redirect(route('verification.notice'));
	}
}
