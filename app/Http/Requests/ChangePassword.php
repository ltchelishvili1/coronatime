<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassword extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
	 */
	public function rules(): array
	{
		return [
			'new_password'       => 'required|min:3|max:255',
			'repeat_password'    => 'required|same:new_password',
		];
	}

	public function messages()
	{
		return [
			'new_password.max'         	=> __('validation.max'),
			'new_password.min'         	=> __('validation.min'),
			'new_password.required'   	 => __('validation.field_validation'),
			'repeat_password.same' 		   => __('validation.password_same'),
			'repeat_password.required'  => __('validation.field_validation'),
		];
	}
}
