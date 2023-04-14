<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class verifyAccount extends Mailable
{
	use Queueable;

	use SerializesModels;

	public $data;

	public function __construct($data)
	{
		$this->data = $data;
	}

	public function build()
	{
		{
			return $this->from('noreply@coronatime.com', )
			->subject('Verify Email')
			->view('auth.signup.email-verify');
		}
	}
}
