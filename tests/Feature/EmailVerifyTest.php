<?php

namespace Tests\Feature;

use App\Mail\ResetPassword;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\CustomVerifyEmailNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Support\Str;

class EmailVerifyTest extends TestCase
{
	use RefreshDatabase;

	/**
	 * A basic feature test example.
	 */
	public function test_email_verification_message_is_sent_page_should_be_accessible()
	{
		$response = $this->get(route('verification.notice'));
		$response->assertSuccessful();
		$response->assertViewIs('auth.resetpassword.email-sent');
	}

	public function test_email_verification_is_updated_in_database()
	{
		$user = User::factory()->create(['is_email_verified' => 0, 'email_verified_at' => null]);
		$response = $this->get(route('verification.verify', ['id' => $user->id, 'hash' =>  sha1($user->email)]));
		$response->assertRedirect(route('login'));
		$this->assertTrue($user->fresh()->hasVerifiedEmail());
		$this->assertTrue($user->fresh()->is_email_verified === 1);
	}

	public function test_emailVerify_method_does_not_update_user_email_verification_status_if_already_verified()
	{
		$user = User::factory()->create(['is_email_verified' => 1]);

		$response = $this->get(route('verification.verify', [
			'id'   => $user->id,
			'hash' => sha1($user->email),
		]));

		$response->assertRedirect(route('login'));

		$this->assertTrue($user->fresh()->hasVerifiedEmail());
		$this->assertTrue($user->is_email_verified == 1);
	}

	public function test_regist_emailsent_returns_correct_view()
	{
		$response = $this->get(route('register.emailsent'));
		$response->assertSuccessful();
		$response->assertViewIs('auth.resetpassword.email-sent');
	}

	public function test_authorize_method_returns_expected_results_when_email_is_verified()
	{
		$user = User::factory()->create(['email_verified_at' => now()]);
		$hash = sha1($user->getEmailForVerification());
		$url = route('verification.verify', ['id' => $user->id, 'hash' => $hash]);
		$response = $this->get($url);
		$response->assertStatus(302);
	}

	public function test_authorize_method_returns_expected_results_when_id_is_wrong()
	{
		$user = User::factory()->create(['email_verified_at' => now()]);
		$hash = sha1($user->getEmailForVerification());

		$url = route('verification.verify', ['id' => 999, 'hash' => $hash]);
		$response = $this->get($url);
		$response->assertForbidden();
	}

	public function test_authorize_method_returns_expected_results_when_hash_is_wrong()
	{
		$user = User::factory()->create(['email_verified_at' => now()]);
		$hash = sha1($user->getEmailForVerification());

		$url = route('verification.verify', ['id' => $user->id, 'hash' => 'invalid-hash']);
		$response = $this->get($url);
		$response->assertForbidden();
	}

	public function test_it_sends_the_reset_password_mail()
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

		Mail::assertSent(ResetPassword::class, function ($mail) {
			$mail->build();
			return true;
		});
	}

	public function test_it_sends_the_email_verify_mail()
	{
		Mail::fake();

		$user = User::factory()->create();
		$notification = new CustomVerifyEmailNotification;
		$email = $notification->toMail($user);

		$this->assertEquals('Verify your email address', $email->subject);
		$this->assertEquals('mails.account-verify', $email->view);
	}
}
