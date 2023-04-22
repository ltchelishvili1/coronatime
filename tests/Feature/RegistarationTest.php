<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\CustomVerifyEmailNotification;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class RegistarationTest extends TestCase
{
	/**
	 * A basic feature test example.
	 */
	public function test_register_page_is_accessible()
	{
		$response = $this->get('/register');
		$response->assertViewIs('auth.signup.index');
	}

	public function test_signup_should_give_us_username_error_if_username_is_not_provided()
	{
		$response = $this->post('/register', [
			'email'           => 'email@email.com',
			'password'        => 'pass',
			'repeat_password' => 'pass',
		]);
		$response->assertSessionHasErrors('username');
		$response->assertSessionDoesntHaveErrors('email', 'password', 'repeat_password');
	}

	public function test_signup_should_give_us_email_error_if_email_is_not_provided()
	{
		$response = $this->post('/register', [
			'username'        => 'user',
			'password'        => 'pass',
			'repeat_password' => 'pass',
		]);
		$response->assertSessionHasErrors('email');
		$response->assertSessionDoesntHaveErrors('password', 'repeat_password', 'username');
	}

	public function test_signup_should_give_us_password_error_if_password_is_not_provided()
	{
		$response = $this->post('/register', [
			'username'        => 'user',
			'email'           => 'email@email.com',
			'repeat_password' => 'pass',
		]);
		$response->assertSessionHasErrors('password');
		$response->assertSessionDoesntHaveErrors('email', 'repeat_password', 'username');
	}

	public function test_signup_should_give_us_repeat_password_error_if_repeat_password_is_not_provided()
	{
		$response = $this->post('/register', [
			'username' => 'user',
			'email'    => 'email@email.com',
			'password' => 'pass',
		]);
		$response->assertSessionHasErrors('repeat_password');
		$response->assertSessionDoesntHaveErrors('email', 'password', 'username');
	}

	public function test_signup_should_give_us_username_error_if_username_is_less_than_3_charachters()
	{
		$response = $this->post('/register', [
			'username'        => 'us',
			'email'           => 'email@email.com',
			'password'        => 'pass',
			'repeat_password' => 'pass',
		]);
		$response->assertSessionHasErrors('username');
		$response->assertSessionDoesntHaveErrors('password', 'email', 'repeat_password');
	}

	public function test_signup_should_give_us_username_error_if_username_is_more_than_255_charachters()
	{
		$response = $this->post('/register', [
			'username'        => 'uswfegrtmrnewbrgefneuswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokplrtwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpl',
			'email'           => 'email@email.com',
			'password'        => 'pass',
			'repeat_password' => 'pass',
		]);
		$response->assertSessionHasErrors('username');
		$response->assertSessionDoesntHaveErrors('password', 'email', 'reset_password');
	}

	public function test_signup_should_give_us_unique_error_if_username_is_not_unique()
	{
		$user = User::factory()->create([
			'is_email_verified' => 1,
		]);

		$response = $this->post('/register', [
			'username'        => $user->username,
			'email'           => 'email@email.com',
			'password'        => 'pass',
			'repeat_password' => 'pass',
		]);
		$response->assertSessionHasErrors('username');
		$response->assertSessionDoesntHaveErrors('password', 'email', 'repeat_password');
	}

	public function test_signup_should_give_us_email_error_if__email_is_not_email()
	{
		$response = $this->post('/register', [
			'username'        => 'test',
			'email'           => 'emailemail.com',
			'password'        => 'pass',
			'repeat_password' => 'pass',
		]);
		$response->assertSessionHasErrors('email');
		$response->assertSessionDoesntHaveErrors('password', 'username', 'repeat_password');
	}

	public function test_signup_should_give_us_email_error_if_email_is_more_than_255_charachters()
	{
		$response = $this->post('/register', [
			'username'        => 'wqfegrt',
			'email'           => 'uswfegrtmrnewbrgefneuswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokplrtwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpluswfegrtmrnewbrgefnertwgfisdajokpl@email.com',
			'password'        => 'pass',
			'repeat_password' => 'pass',
		]);
		$response->assertSessionHasErrors('email');
		$response->assertSessionDoesntHaveErrors('password', 'username', 'reset_password');
	}

	public function test_signup_should_give_us_unique_error_if_email_is_not_unique()
	{
		$user = User::factory()->create([
			'is_email_verified' => 1,
		]);

		$response = $this->post('/register', [
			'username'        => 'test',
			'email'           => $user->email,
			'password'        => 'pass',
			'repeat_password' => 'pass',
		]);
		$response->assertSessionHasErrors('email');
		$response->assertSessionDoesntHaveErrors('password', 'username', 'repeat_password');
	}

	public function test_signup_should_give_us_repeat_username_error_if_password_is_less_than_3_charachters()
	{
		$response = $this->post('/register', [
			'username'        => 'user',
			'email'           => 'email@email.com',
			'password'        => 'pa',
			'repeat_password' => 'pa',
		]);
		$response->assertSessionHasErrors('password');
		$response->assertSessionDoesntHaveErrors('email', 'username', 'repeat_password');
	}

	public function test_signup_should_give_us_not_same_error_if_repeat_password_is_not_same_as_password()
	{
		$response = $this->post('/register', [
			'username'        => 'us',
			'email'           => 'email@email.com',
			'password'        => 'pass',
			'repeat_password' => 'passw',
		]);
		$response->assertSessionHasErrors('repeat_password');
		$response->assertSessionDoesntHaveErrors('password', 'username', 'email');
	}

	public function test_signip_user_store()
	{
		$response = $this->post('/register', [
			'username'        => 'user',
			'email'           => 'email@email.com',
			'password'        => 'password',
			'repeat_password' => 'password',
		]);

		$user = User::where('username', 'user')->first();
		$this->assertNotNull($user);
		$this->assertEquals('email@email.com', $user->email);
	}

	public function test_email_verification_notification_is_sent_after_registering()
	{
		Notification::fake();

		$user = User::factory()->make();

		$response = $this->post(route('register'), [
			'username'        => $user->username,
			'email'           => $user->email,
			'password'        => 'password',
			'repeat_password' => 'password',
		]);

		$response->assertStatus(302);

		$user = User::where('email', $user->email)->first();

		$notification = new CustomVerifyEmailNotification();
		Notification::route('mail', $user['email'])->notify($notification);

		Notification::assertSentTo(
			$user,
			CustomVerifyEmailNotification::class,
			function ($notification, $channels, $notifiable) use ($user) {
				return $notifiable->email === $user->email;
			}
		);
	}
}
