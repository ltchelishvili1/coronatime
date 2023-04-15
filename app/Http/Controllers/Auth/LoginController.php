<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
	public function login(LoginRequest $request): RedirectResponse
	{
		$validated = $request->validated();
		$remember_me = false;

		if (preg_match('/^\S+@\S+\.\S+$/', $validated['username'])) {
			$validated['email'] = $validated['username'];

			$user = User::where('email', $validated['email'])->first();

			unset($validated['username']);
		} else {
			$user = User::where('username', $validated['username'])->first();
		}

		if (array_key_exists('remember_me', $validated)) {
			$remember_me = $validated['remember_me'];
			unset($validated['remember_me']);
		}

		if (!auth()->attempt($validated, $remember_me)) {
			throw ValidationException::withMessages([
				'username' => 'wrong credentials',
			]);
		}
		if ($user->email_verified_at === null) {
			throw ValidationException::withMessages([
				'username' => 'Email is not verified',
			]);

			return redirect('login');
		}
		session()->regenerate();

		return redirect('dashboard');
	}

	public function logout(): RedirectResponse
	{
		auth()->logout();

		return redirect(route('login'));
	}
}
