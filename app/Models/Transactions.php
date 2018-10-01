<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
	protected $table = 'transactions';

	protected $fillable = [
		'transaction_id',
        'user_id',
		'status',  //status of transaction
        'send', // mining status transaction
		'currency',  //currency of amount
		'from',
		'amount',  //amount in original currency
		'amount_tokens', //amount converted from ETH to Tokens
		'info', //amount converted from ETH to Tokens
		'date',  // of transactions
	];

	public function user()
    {
        return $this->belongsTo(User::class);
    }
}
