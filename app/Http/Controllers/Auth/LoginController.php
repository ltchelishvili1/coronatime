<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{
	public function index(): View
	{
		return view('auth.login.index');
	}

	public function login(LoginRequest $request): RedirectResponse
	{
		$validated = $request->validated();
		$fieldType = filter_var($validated['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
		$user = User::where('username', $validated['username'])
		->orWhere('email', $validated['username'])->first();

		//middleware gaketebas memgoni azri araqvs imitom rom araverificirebuli verc logindeba da shesabamisad yvela auth verificirebulia
		if ($user && $user->is_email_verified == 0) {
			throw ValidationException::withMessages([
				'username' => __('validation.email_not_verified'),
			]);
		}

		if (auth()->attempt([$fieldType => $validated['username'], 'password' => $validated['password']], $request['remember_me'])) {
			return redirect(route('dashboard.index'));
		} else {
			throw ValidationException::withMessages([
				'username' => __('validation.wrong_credential'),
			]);
		}
	}

	public function logout(): RedirectResponse
	{
		auth()->logout();

		return redirect(route('login.index'));
	}
}
