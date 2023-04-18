<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailVerifyRequest;
use Illuminate\Http\RedirectResponse;

class EmailVerifyController extends Controller
{
	public function emailVerify(EmailVerifyRequest $request): RedirectResponse
	{
		$request->fulfill();

		return redirect(route('login'));
	}
}
