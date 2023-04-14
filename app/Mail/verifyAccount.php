<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class verifyAccount extends Mailable
{
	use Queueable;

	use SerializesModels;

	public $token;

	public function __construct($token)
	{
		$this->token = $token;
	}

	public function build()
	{
		{
			return $this->from('noreply@coronatime.com', )
			->subject('Verify Email')
			->view('auth.signup.email-verify', [
				'token' => $this->token,
			]);
		}
	}
}
