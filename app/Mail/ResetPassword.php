<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
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
			->subject('Update Password')
			->view('auth.resetpasswordreq.email-verify', [
				'token' => $this->token,
			]);
		}
	}
}
