<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LanguageTest extends TestCase
{
	use RefreshDatabase;

	public function test_check_if_language_is_stored_in_session(): void
	{
		$language = 'ka';
		$response = $this->get(route('set-language', ['language' => $language]));
		$response->assertRedirect();
		$this->assertEquals($language, session('locale'));
	}

	public function test_language_switch_en()
	{
		$response = $this->get(route('set-language', 'en'));
		$response->assertSessionHasNoErrors();
	}

	public function test_language_switch_ka()
	{
		$response = $this->get(route('set-language', 'ka'));
		$response->assertSessionHasNoErrors();
	}

	public function test_language_change_session()
	{
		$user = User::factory()->create([
			'is_email_verified' => 1,
		]);
		$this->actingAs($user)->withSession(['locale' => 'ka']);
		$response = $this->get('/dashboard');
		$this->assertEquals('ka', app()->getLocale());
		$response->assertSee('მსოფლიო სტატისტიკა')
				 ->assertDontSee('Worldwide Statistics');
	}
}
