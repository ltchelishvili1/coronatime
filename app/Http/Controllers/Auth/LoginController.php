<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
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
		$input = $request->all();
		$fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
		if (auth()->attempt([$fieldType => $input['username'], 'password' => $input['password']], $request['remember_me'])) {
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
