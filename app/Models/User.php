<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'valid_step', 'valid_at', 'confirmed', 'confirmed_at', 'reg_attempts', 'reset_attempts', 'token',  'referred_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    // RELATIONS


    public function links()
    {
        return $this->hasMany("App\\Models\\Link");
    }

    public function conversions()
    {
        return $this->hasMany("App\\Models\\Conversion");
    }

    public function wallets()
    {
        return $this->hasOne("App\\UserWalletFields");
    }


}
