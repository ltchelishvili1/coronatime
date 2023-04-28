<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
	 */
	public function rules(): array
	{
		return [
			'username'       => 'required|min:3|max:255|unique:users',
			'email'          => 'required|email|max:255|unique:users',
			'password'       => 'required|min:3|max:255',
			'repeat_password'=> 'required|same:password',
		];
	}
}
