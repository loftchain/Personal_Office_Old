<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use SoftDeletes;

    /**
     * Массово присваиваемые атрибуты.
     * @var array
     */
    protected $fillable = ['user_id','affiliate_id','comment'];

    /**
     * The attributes that should be mutated to dates.
     * @var array
     */
    protected $dates = ['deleted_at'];

    //
    public function conversions()
    {
        return $this->hasMany("App\\Models\\Conversion");
    }

    public function user()
    {
        return $this->belongsTo('App\\Models\\User', 'user_id');
    }

}

