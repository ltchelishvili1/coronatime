<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
	use Queueable;

	use SerializesModels;

	public string $token;

	public function __construct(string $token)
	{
		$this->token = $token;
	}

	public function build(): Mailable
	{
		return $this
			->from('noreply@coronatime.com')
			->subject('Update Password')
			->view('auth.resetpasswordreq.email-verify', [
				'token' => $this->token,
			]);
	}
}
