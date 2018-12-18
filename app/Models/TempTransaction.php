<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempTransaction extends Model
{
    protected $fillable = [
        'status',
        'amount',
        'currency',
        'transaction_id',
        'from',
        'date',
    ];
}
