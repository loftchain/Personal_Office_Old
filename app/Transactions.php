<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $table = 'transactions';
    
    protected $fillable = [
        'status',  //status of transaction
        'currency',  //currency of amount
        'wallet_from',
        'wallet_to',
        'amount',  //amount in original currency
        'amount_eth', // amount converted from original currency to ETH
        'amount_tokens', //amount converted from ETH to Tokens
        'transaction_id',
        'date',  // of transactions
        'block_id',  //current block for transsactions
        'rate_tx_eth',  // rate from eth to currency
        'rate_eth_cur',  // rate from original to ETH
        'raw', // raw data of transactions
    ];
}
