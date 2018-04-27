<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserPersonalFields extends Authenticatable
{
	use Notifiable;


	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'name_surname',
		'phone',
		'telegram',
		'emergency_email',
		'permanent_address',
		'contact_number',
		'date_place_birth',
		'nationality',
		'source_of_funds',
		'doc_img_path',
	];

	protected $casts = [
		'doc_img_path' => 'array',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [

	];
}
