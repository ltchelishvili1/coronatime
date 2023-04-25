<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class FetchCommandTest extends TestCase
{
	/**
	 * A basic feature test example.
	 */
	public function test_fetch_command()
	{
		Http::fake([
			'https://devtest.ge/countries' => Http::response([
				[
					'code'=> 'GE',
					'name'=> [
						'en'=> 'Georgia',
						'ka'=> 'საქართველო',
					],
				],
			], 200),

			'https://devtest.ge/get-country-statistics' => Http::response([
				'id'        => 1,
				'country'   => 'Georgia',
				'code'      => 'GE',
				'confirmed' => 2,
				'recovered' => 3,
				'critical'  => 4,
				'deaths'    => 5,
				'created_at'=> now(),
				'updated_at'=> now(),
			], 200),
		]);
		$this->artisan('fetch:covid-stats')->assertSuccessful();
	}
}
