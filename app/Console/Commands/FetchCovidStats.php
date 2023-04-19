<?php

namespace App\Console\Commands;

use App\Models\Statistic;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchCovidStats extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'fetch-covid-stats';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'fetch covid statistics';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		$countries = Http::get('https://devtest.ge/countries')->json();

		foreach ($countries as $country) {
			$stats = Http::timeout(300)->post('https://devtest.ge/get-country-statistics', ['code'=>$country['code']])->json();

			Statistic::updateOrCreate([
				'id'       => $stats['id'],
				'code'     => $country['code'],
				'country'  => json_encode([
					'en'=> $country['name']['en'],
					'ka'=> $country['name']['ka'],
				]),
				'confirmed'=> $stats['confirmed'],
				'recovered'=> $stats['recovered'],
				'critical' => $stats['critical'],
				'deaths'   => $stats['deaths'],
			]);
		}
		$this->info('COVID statistics have been successfully fetched and updated.');
	}
}
