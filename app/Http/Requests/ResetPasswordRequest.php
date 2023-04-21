<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
	 */
	public function rules(): array
	{
		return [
			'email' => 'required|email|exists:users,email',
		];
	}

	public function messages()
	{
		return [
			'email.required'   			=> __('validation.field_validation'),
			'email.exists'      		=> __('validation.email_exists_not'),
			'email.email' 				    => __('validation.shouldbe_email'),
		];
	}
}
