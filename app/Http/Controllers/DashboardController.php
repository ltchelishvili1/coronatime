<?php

namespace App\Http\Controllers;

use App\Http\Requests\SortRequest;
use App\Models\Statistic;
use Illuminate\View\View;

class DashboardController extends Controller
{
	public $stats;

	public function index(): View
	{
		$stats = [
			'confirmed' => Statistic::sum('confirmed'),
			'deaths'    => Statistic::sum('deaths'),
			'recovered' => Statistic::sum('recovered'),
		];
		return view('dashboard.index', ['stats' => $stats]);
	}

	public function bycountry(SortRequest $request): View
	{
		$stats = [
			'confirmed' => Statistic::sum('confirmed'),
			'deaths'    => Statistic::sum('deaths'),
			'recovered' => Statistic::sum('recovered'),
		];

		return view('dashboard.bycountry', ['countries' => $request->getFilteredData(), 'stats' => $stats]);
	}
}
