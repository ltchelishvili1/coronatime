<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\CustomVerifyEmailNotification;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements MustVerifyEmail
{
	use HasApiTokens;

	use HasFactory;

	use Notifiable;

	protected $guarded = ['id'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected array $fillable = [
		'name',
		'email',
		'password',
		'username',
		'token',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected array $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected array $casts = [
		'email_verified_at' => 'datetime',
	];

	public function setPasswordAttribute(string $password): void
	{
		$this->attributes['password'] = bcrypt($password);
	}

	public function passwordReset(): HasMany
	{
		return $this->hasMany(PasswordReset::class, 'email', 'email');
	}

	public function sendEmailVerificationNotification(): void
	{
		$this->notify(new CustomVerifyEmailNotification);
	}
}
