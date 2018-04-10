<?php

namespace App\Services;

use App\Helpers\ICOAPI;
use App\Models\UserWalletFields;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\HomeController;
use GuzzleHttp\Client;
use App\Services\BonusService;


class TransactionService
{

	protected $bonusService;
	protected $txService;

	public function __construct(BonusService $bonusService)
	{
		$this->bonusService = $bonusService;
	}

	public function getTransactions(){
		$client = new Client();
		$res = $client->request('GET', env('SELF_API_URL') . '/api/tx/' . env('OWNER_ID'));
		$body = json_decode($res->getBody());
		return $body;
	}

	public function countTokens($currency, $amount, $date){
		$tokens = 0;
		$curs = $this->bonusService->getLatestCurrencies();
		$txTimestamp = strtotime($date);
		$closest = null;

		foreach ($curs as $c) {
			if ($closest === null || abs($txTimestamp - $closest) > abs($c->timestamp - $txTimestamp)) {
				$closest = $c->timestamp;
			}
			Log::info($closest);

//			switch($currency){
//				case 'ETH':
//
//					break;
//			}
		}

		return $tokens;
	}

	public function storeTx(){
		$tx = $this->getTransactions();
		$db = [];
		$curs = $this->bonusService->getLatestCurrencies();


		foreach ($tx as $t) {
					$db[] = [
						'transaction_id' => $t->txId,
						'status' => $t->status,
						'currency' => $t->currency,
						'from' => $t->from,
						'amount' => $t->amount,
						'amount_tokens' => $this->countTokens($t->currency, $t->amount, $t->date),
						'date' => $t->date
					];
			}

//		for ($k = 0; $k < count($db); $k++) {
//			if (!Transactions::where('txId', '=', $db[$k]['txId'])->exists()) {
//				Transactions::create($db[$k]);
//			}
//		}

		return $db;
	}

}