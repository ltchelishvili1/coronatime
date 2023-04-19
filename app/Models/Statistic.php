<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
	use HasFactory;

	public function scopeFilter($query, array $filters)
	{
		$query->when($filters['search'] ?? false, function ($query, $search) {
			$query->where(function ($query) use ($search) {
				$query->where('country->en', 'like', '%' . ucwords($search) . '%')
					->orWhere('country->ka', 'like', '%' . $search . '%');
			});
		});

		$query->when($filters['country'] ?? false, function ($query, $search) {
			$query->orderBy('country->en', $search);
		});

		$query->when($filters['recovered'] ?? false, function ($query, $search) {
			$query->orderBy('recovered', $search);
		});
		$query->when($filters['deaths'] ?? false, function ($query, $search) {
			$query->orderBy('deaths', $search);
		});
		$query->when($filters['confirmed'] ?? false, function ($query, $search) {
			$query->orderBy('confirmed', $search);
		});
	}

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
}
