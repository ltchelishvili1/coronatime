<?php

namespace Tests\Feature;

use App\Models\Statistic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashbordTest extends TestCase
{
	use RefreshDatabase;

	protected $statisticA;

	protected $statisticB;

	protected $statisticC;

	public function setUp(): void
	{
		parent::setUp();

		$this->statisticA = Statistic::factory()->create(
			[
				'country'   => json_encode(['en' => '3United States', 'ka' => '3აშშ']),
				'recovered' => 1111,
				'deaths'    => 1111,
				'confirmed' => 1111]
		);
		$this->statisticB = Statistic::factory()->create([
			'country'   => json_encode(['en' => '1Canada', 'ka' => '1კანადა']),
			'recovered' => 1112,
			'deaths'    => 1112,
			'confirmed' => 1112]);
		$this->statisticC = Statistic::factory()->create([
			'country'   => json_encode(['en' => '2Mexico', 'ka' => '2მექსიკა']),
			'recovered' => 1113,
			'deaths'    => 1113,
			'confirmed' => 1113]);
	}

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

	public function test_if_search_works()
	{
		$user = User::factory()->create([
			'is_email_verified' => 1,
		]);

		$countryName = json_decode(Statistic::factory()->create()->country)->en;
		$response = $this->actingAs($user)->get(route('dashboard.bycountry', ['countries'=>Statistic::where('country', 'like', '%' . $countryName . '%')->get()]));
		$response->assertSeeText($countryName);
	}

	public function test_on_dashboard_country_search()
	{
		$user = User::factory()->create([
			'is_email_verified' => 1,
		]);
		$response = $this->actingAs($user)->get(route('dashboard.bycountry'), [
			'search' => 'a',
		]);
		$response->assertSuccessful();
	}

	public function test_if_location_sorting_desc()
	{
		$user = User::factory()->create([
			'is_email_verified' => 1,
		]);
		$response = $this->actingAs($user)->get(route('dashboard.bycountry'), [
			'location' => 'desc',
		]);
		$response->assertSuccessful();
	}

	public function test_if_location_sorting_asc()
	{
		$user = User::factory()->create([
			'is_email_verified' => 1,
		]);
		$response = $this->actingAs($user)->get(route('dashboard.bycountry'), [
			'location' => 'asc',
		]);
		$response->assertSuccessful();
	}

	public function test_if_confirmed_sorting_desc()
	{
		$user = User::factory()->create([
			'is_email_verified' => 1,
		]);
		$response = $this->actingAs($user)->get(route('dashboard.bycountry'), [
			'confirmed' => 'desc',
		]);
		$response->assertSuccessful();
	}

	public function test_if_confirmed_sorting_asc()
	{
		$user = User::factory()->create([
			'is_email_verified' => 1,
		]);
		$response = $this->actingAs($user)->get(route('dashboard.bycountry'), [
			'confirmed' => 'asc',
		]);

		$response->assertSuccessful();
	}

	public function test_if_deaths_sorting_desc()
	{
		$user = User::factory()->create([
			'is_email_verified' => 1,
		]);
		$response = $this->actingAs($user)->get(route('dashboard.bycountry'), [
			'deaths' => 'desc',
		]);
		$response->assertSuccessful();
	}

	public function test_if_deaths_sorting_asc()
	{
		$user = User::factory()->create([
			'is_email_verified' => 1,
		]);
		$response = $this->actingAs($user)->get(route('dashboard.bycountry'), [
			'deaths' => 'asc',
		]);
		$response->assertSuccessful();
	}

	public function test_if_recovered_sorting_desc()
	{
		$user = User::factory()->create([
			'is_email_verified' => 1,
		]);
		$response = $this->actingAs($user)->get(route('dashboard.bycountry'), [
			'recovered' => 'desc',
		]);
		$response->assertSuccessful();
	}

	public function test_if_recovered_sorting_asc()
	{
		$user = User::factory()->create([
			'is_email_verified' => 1,
		]);
		$response = $this->actingAs($user)->get(route('dashboard.bycountry'), [
			'recovered' => 'asc',
		]);
		$response->assertSuccessful();
	}

	 public function test_it_can_filter_by_search_term()
	 {
	 	$user = User::factory()->create();

	 	$response = $this->actingAs($user)->get('/dashboard-by-country?search=United');

	 	$response->assertSee(json_decode($this->statisticA->country)->en);
	 	$response->assertDontSee(json_decode($this->statisticB->country)->en);
	 	$response->assertDontSee(json_decode($this->statisticC->country)->en);
	 }

		public function test_it_can_filter_by_country()
		{
			$user = User::factory()->create();

			$response = $this->actingAs($user)->get('/dashboard-by-country?country=asc');

			$response->assertSeeInOrder([json_decode($this->statisticB->country)->en,
				json_decode($this->statisticC->country)->en, json_decode($this->statisticA->country)->en]);

			$response = $this->actingAs($user)->get('/dashboard-by-country?country=desc');

			$response->assertSeeInOrder([
				json_decode($this->statisticA->country)->en,	 json_decode($this->statisticC->country)->en, json_decode($this->statisticB->country)->en, ]);
		}

		public function test_it_can_filter_by_recovered()
		{
			$user = User::factory()->create();

			$response = $this->actingAs($user)->get('/dashboard-by-country?recovered=asc');

			$response->assertSuccessful();
		}

		public function test_it_can_filter_by_deaths()
		{
			$user = User::factory()->create();

			$response = $this->actingAs($user)->get('/dashboard-by-country?deaths=asc');

			$response->assertSuccessful();
		}

		public function test_it_can_filter_by_confirmed()
		{
			$user = User::factory()->create();

			$response = $this->actingAs($user)->get('/dashboard-by-country?confirmed=asc');

			$response->assertSuccessful();
		}
}
