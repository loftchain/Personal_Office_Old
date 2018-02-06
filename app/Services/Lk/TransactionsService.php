<?php

namespace App\Services\Lk;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class TransactionsService
{
	public function getUserTransactions($user_id) {
		return collect(DB::select("SELECT t.transaction_id, t.wallet_from, t.wallet_to, t.amount_eth, t.amount_tokens, t.currency, t.date 
								   FROM transactions AS t 
								   INNER JOIN user_wallet_fields AS w ON t.wallet_from = w.ETH OR t.wallet_to = w.ETH 
								   WHERE w.user_id = ? 
								   ORDER BY date, currency", [$user_id]))->all();
	}
}