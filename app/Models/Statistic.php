<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
	use HasFactory;

	protected $guarded = [
		'id',
	];

	protected $fillable = [
		'country',
		'code',
		'confirmed',
		'recovered',
		'critical',
		'deaths',
	];

	public function scopeFilter($query, array $filters)
	{
		$query->when($filters['search'] ?? false, function ($query, $search) {
			$query->where(function ($query) use ($search) {
				$query->where('country->en', 'like', '%' . ucwords($search) . '%')
					->orWhere('country->ka', 'like', '%' . $search . '%');
			});
		});

		$query->when($filters['country'] ?? false, function ($query, $country) {
			$query->orderBy('country->en', $country);
		});

		$query->when($filters['recovered'] ?? false, function ($query, $order) {
			$query->orderBy('recovered', $order);
		});
		$query->when($filters['deaths'] ?? false, function ($query, $order) {
			$query->orderBy('deaths', $order);
		});
		$query->when($filters['confirmed'] ?? false, function ($query, $order) {
			$query->orderBy('confirmed', $order);
		});
	}
}
