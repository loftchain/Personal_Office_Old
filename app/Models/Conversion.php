<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    protected $fillable = ['user_id', 'link_id', 'user_agent', 'ip'];
    //
    public function user()
    {
        return $this->belongsTo('App\\Models\\User', 'user_id');
    }

    public function link()
    {
        return $this->belongsTo('App\\Models\\Link', 'user_id');
    }

}

