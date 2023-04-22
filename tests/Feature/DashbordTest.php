<?php

namespace Tests\Feature;

use App\Models\Statistic;
use App\Models\User;
use Tests\TestCase;

class DashbordTest extends TestCase
{
	/**
	 * A basic feature test example.
	 */
	public function test_dashboard_index_page_should_be_accessible()
	{
		$user = User::factory()->create();

		$response = $this->actingAs($user)->get(route('dashboard.index'));

		$response->assertStatus(200);
	}

	public function test_dashboard_index_method_returns_view_with_statistics()
	{
		$user = User::factory()->create();
		$response = $this->actingAs($user)->get(route('dashboard.index'));
		$response->assertSuccessful();

		$response->assertViewIs('dashboard.index');
		$response->assertViewHas('stats', [
			'confirmed' => Statistic::sum('confirmed'),
			'deaths'    => Statistic::sum('deaths'),
			'recovered' => Statistic::sum('recovered'),
		]);
	}

	public function test_dashboard_bycountry_method_returns_view_with_statistics()
	{
		$user = User::factory()->create();
		$response = $this->actingAs($user)->get(route('dashboard.bycountry'));
		$response->assertSuccessful();

		$response->assertViewIs('dashboard.bycountry');
		$response->assertViewHas('stats', [
			'confirmed' => Statistic::sum('confirmed'),
			'deaths'    => Statistic::sum('deaths'),
			'recovered' => Statistic::sum('recovered'),
		]);
	}
}
