<?php

namespace App\Http\Requests;

use App\Models\Statistic;
use Illuminate\Foundation\Http\FormRequest;

class SortRequest extends FormRequest
{
	public function rules()
	{
		return [
			'search'    => ['nullable', 'string'],
			'country'   => ['nullable', 'string'],
			'recovered' => ['nullable', 'string'],
			'deaths'    => ['nullable', 'string'],
			'confirmed' => ['nullable', 'string'],
		];
	}

	public function filters()
	{
		return [
			'search'    => 'trim|escape',
			'country'   => 'trim|escape',
			'recovered' => 'trim|escape',
			'deaths'    => 'trim|escape',
			'confirmed' => 'trim|escape',
		];
	}

	public function getFilteredData()
	{
		$filters = $this->validated();
		$countries = Statistic::filter($filters)->get();
		return $countries;
	}
}
