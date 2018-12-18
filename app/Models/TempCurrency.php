<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempCurrency extends Model
{
    protected $fillable = [
        'pair',
        'price',
        'timestamp',
    ];
}
