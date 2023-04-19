<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailVerifyRequest;
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
		$request->fulfill();
		return redirect(route('login'));
	}
}
