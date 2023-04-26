<?php

namespace Tests\Feature;

use App\Mail\ResetPassword;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
	use RefreshDatabase;

	/**
	 * A basic feature test example.
	 */
	use WithFaker;

	public function test_reset_password_return_correct_view()
	{
		$token = Str::random(60);
		$user = User::factory()->create([
			'token' => $token,
		]);

		$response = $this->get(route('password.resetform', ['token' => $user->token]));
		$response->assertSuccessful();
		$response->assertViewIs('auth.resetpassword.index');
	}

	public function test_if_reset_password_email_is_sent()
	{
		$token = Str::random(60);
		$user = User::factory()->create(['token' => $token]);
		PasswordReset::create([
			'email'      => $user->email,
			'token'      => $user->token,
			'created_at' => now(),
		]);

		Mail::fake();

		$response = $this->post(route('password.resetrequest.post', [
			'email' => $user->email,
		]));

		Mail::assertSent(ResetPassword::class, function ($mail) use ($user, $token) {
			return $mail->hasTo($user->email);
		});

		$response->assertRedirect(route('register.emailsent'));
	}

	public function test_if_password_is_correctly_changed()
	{
		$user = User::factory()->create([
			'password' => Hash::make('password'),
		]);

		$passwordReset = PasswordReset::create([
			'email'      => $user->email,
			'token'      => Str::random(60),
			'created_at' => now(),
		]);

		$response = $this->post(route('password.update', [
			'token' => $passwordReset->token,
		]), [
			'new_password'    => 'new_pass',
			'repeat_password' => 'new_pass',
		]);

		$response->assertRedirect(route('passwordchanged'));
		$user->refresh();
		$this->assertTrue(Hash::check('new_pass', $user->password));
	}

	public function test_check_if_password_changed_route_returns_correct_view()
	{
		$response = $this->get(route('passwordchanged'));
		$response->assertSuccessful();
		$response->assertViewIs('auth.resetpasswordreq.password-changed');
	}

	public function test_if_reset_request_route_returns_correct_view()
	{
		$response = $this->get(route('password.resetrequest'));
		$response->assertSuccessful();
		$response->assertViewIs('auth.resetpasswordreq.index');
	}

	public function test_if_reset_password_view_has_error_when_password_field_is_empty()
	{
		$response = $this->post(route('password.update', ['token' => Str::random(60)]), [
			'new_password'    => null,
			'repeat_password' => 'password',
		]);

		$response->assertSessionHasErrors('new_password');
	}

	public function test_if_reset_password_view_has_error_when_repeat_password_field_is_empty()
	{
		$response = $this->post(route('password.update', ['token' => Str::random(60)]), [
			'new_password'    => 'password',
			'repeat_password' => null,
		]);

		$response->assertSessionHasErrors('repeat_password');
	}

	public function test_if_reset_password_view_has_error_when_password_length_is_less_than_3()
	{
		$response = $this->post(route('password.update', ['token' => Str::random(60)]), [
			'new_password'    => 'p',
			'repeat_password' => 'p',
		]);

		$response->assertSessionHasErrors('new_password');
	}

	public function test_if_reset_password_view_has_error_when_password_length_is_more_than_255()
	{
		$response = $this->post(route('password.update', ['token' => Str::random(60)]), [
			'new_password'    => 'passwordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpasswordpassword',
			'repeat_password' => 'sdsadf',
		]);

		$response->assertSessionHasErrors('new_password');
	}

	public function test_if_reset_password_view_has_error_when_repeat_password_is_different_from_password()
	{
		$response = $this->post(route('password.update', ['token' => Str::random(60)]), [
			'new_password'    => 'pssword',
			'repeat_password' => 'sdsadf',
		]);

		$response->assertSessionHasErrors('repeat_password');
	}
}
