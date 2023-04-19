<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
	public function index(): View
	{
		return view('dashboard.index');
	}

	public function bycountry(): View
	{
		return view('dashboard.bycountry');
	}
}