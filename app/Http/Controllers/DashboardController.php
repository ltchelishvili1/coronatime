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
			'confirmed' => number_format(Statistic::sum('confirmed')),
			'deaths'    => number_format(Statistic::sum('deaths')),
			'recovered' => number_format(Statistic::sum('recovered')),
		];
		return view('dashboard.index', ['stats' => $stats]);
	}

	public function bycountry(SortRequest $request): View
	{
		$stats = [
			'confirmed' => number_format(Statistic::sum('confirmed')),
			'deaths'    => number_format(Statistic::sum('deaths')),
			'recovered' => number_format(Statistic::sum('recovered')),
		];

		return view('dashboard.bycountry', ['countries' => $request->getFilteredData(), 'stats' => $stats]);
	}
}
