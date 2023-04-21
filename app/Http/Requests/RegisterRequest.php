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
			'email'          => 'required|email|unique:users',
			'password'       => 'required|min:3|max:255',
			'repeat_password'=> 'required|same:password',
		];
	}

	public function messages()
	{
		return [
			'password.max'         		   => __('validation.max'),
			'password.min'         		   => __('validation.min'),
			'password.required'   		    => __('validation.field_validation'),
			'repeat_password.same' 		   => __('validation.password_same'),
			'repeat_password.required'  => __('validation.field_validation'),
			'username.max'         		   => __('validation.max'),
			'username.min'         		   => __('validation.min'),
			'username.required'    		   => __('validation.field_validation'),
			'username.unique'      		   => __('validation.username_unique'),
			'email.required'   			      => __('validation.field_validation'),
			'email.unique'      		      => __('validation.email_unique'),
			'email.email' 				          => __('validation.shouldbe_email'),
		];
	}
}
