<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
	public function setLanguage($lang): RedirectResponse
	{
		if (array_key_exists($lang, Config::get('languages'))) {
			Session::put('locale', $lang);
		}
		return redirect()->back();
	}
}
