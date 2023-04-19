<?php

namespace App\Http\Controllers;

use App\Http\Requests\SortRequest;
use Illuminate\View\View;

class DashboardController extends Controller
{
	public function index(): View
	{
		return view('dashboard.index');
	}

	public function bycountry(SortRequest $request): View
	{
		return view('dashboard.bycountry', ['countries' => $request->getFilteredData()]);
	}
}
