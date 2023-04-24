<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
	 */
	public function rules(): array
	{
		return [
			'username' => [
				'required',
				'string',
				function ($attribute, $value, $fail) {
					$user = User::where('username', $value)
								->orWhere('email', $value)
								->first();

					if (!$user) {
						$fail(__('validation.user_not_found'));
					}
				},
			],
			'password'    => 'required|max:255',
			'remember_me' => 'nullable',
		];
	}

	public function messages()
	{
		return [
			'password.max'         => __('validation.max'),
			'password.required'    => __('validation.field_validation'),
			'username.max'         => __('validation.max'),
			'username.min'         => __('validation.min'),
			'username.required'    => __('validation.field_validation'),
			'username.exists'      => __('validation.user_not_found'),
		];
	}
}
