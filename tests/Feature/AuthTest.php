<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
	/**
	 * A basic feature test example.
	 */
	use RefreshDatabase;

	public function test_login_page_is_accessible()
	{
		$response = $this->get('/login');
		$response->assertViewIs('auth.login.index');
	}

	public function test_auth_should_give_us_username_error_if_username_is_not_provided()
	{
		$response = $this->post('/login', [
			'username' => null,
			'password' => 'password',
		]);

		$response->assertSessionHasErrors('username');
		$response->assertSessionDoesntHaveErrors('password');
	}

	public function test_auth_should_give_us_password_error_if_we_wont_provide_password_input()
	{
		$user = User::factory()->create();
		$response = $this->post('/login', [
			'username' => $user->username,
			'password' => null,
		]);

		$response->assertSessionHasErrors('password');
		$response->assertSessionDoesntHaveErrors('username');
	}

	public function test_auth_should_give_us_errors_if_input_is_not_provided()
	{
		$response = $this->post('/login', [
			'username' => null,
			'password' => null,
		]);

		$response->assertSessionHasErrors('password', 'username');
	}

	public function test_auth_should_give_us_username_error_when_username_field_contains_less_than_3_symbols()
	{
		$response = $this->post('/login', [
			'username' => 'sd',
			'password' => 'password',
		]);

		$response->assertSessionHasErrors('username', __('validation.min'));
	}

	public function test_login_is_impossible_if_user_email_is_not_verified_login_with_username()
	{
		$response = $this->post('/login', [
			'username' => 'nonexistent-user',
			'password' => 'invalid-password',
		]);

		$response->assertSessionHasErrors('username');
	}

	public function test_login_is_impossible_if_user_email_is_not_verified_login_with_email()
	{
		$user = User::factory()->create([
			'is_email_verified' => 0,
			'email_verified_at' => null,
		]);

		$response = $this->post(route('login'), [
			'username' => "$user->username",
			'password' => 'password',
		]);

		$response->assertSessionHasErrors('username', __('validation.email_not_verified'));
	}

	public function test_auth_should_give_us_incorrect_user_not_found_error_when_such_user_does_not_exists()
	{
		$response = $this->post(route('login'), [
			'username' => 'nonexistentuser',
			'password' => 'incorrectpassword',
		]);

		$response->assertSessionHasErrors('username', 'validation.user_not_found');
	}

	public function test_auth_should_give_us_incorrect_credentials_error_when_password_is_wrong()
	{
		$user = User::factory()->create([
			'password'          => 'password',
			'is_email_verified' => 1,
		]);

		$response = $this->post(route('login'), [
			'username' => $user->username,
			'password' => 'incorrectpassword',
		]);

		$response->assertSessionHasErrors('username', 'validation.user_not_found');
	}

	public function test_auth_should_redirect_to_dashboard_page_after_successfull_login_with_username()
	{
		$user = User::factory()->create([
			'is_email_verified' => 1,
			'password'          => 'password',
		]);

		$response = $this->post(route('login'), [
			'username' => "$user->username",
			'password' => 'password',
		]);

		$response->assertSessionHasNoErrors();
		$response->assertRedirect(route('dashboard.index'));
	}

	public function test_user_can_successfully_logout()
	{
		// Create a user
		$user = User::factory()->create();
		auth()->login($user);
		$response = $this->get('/logout');
		$response->assertRedirect('/login');
		$this->assertFalse(auth()->check());
	}
}
