<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmailNotification extends VerifyEmail
{
	/**
	 * Build the mail representation of the notification.
	 *
	 * @param mixed $notifiable
	 *
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable)
	{
		return (new MailMessage)
			->subject('Verify your email address')
			->action('Verify Email', $this->verificationUrl($notifiable))
			->view('auth.signup.email-verify', ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]);
	}
}
