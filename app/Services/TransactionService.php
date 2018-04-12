<?php

namespace App\Services;

use App\Helpers\ICOAPI;
use App\Models\Transactions;
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
	protected $walletService;

	public function __construct(BonusService $bonusService, WalletService $walletService)
	{
		$this->bonusService = $bonusService;
		$this->walletService = $walletService;
	}

	public function getTransactions()
	{
		$client = new Client();
		$res = $client->request('GET', env('SELF_API_URL') . '/api/tx/' . env('OWNER_ID'));
		$body = json_decode($res->getBody());
		return $body;
	}

	public function getClosest($search, $arr)
	{
		$closest = null;
		foreach ($arr as $k => $v) {
			if ($closest === null || abs($search - $closest) > abs($v - $search)) {
				$closest = $v;
			}
		}
		return $closest;
	}

	public function countTokens($curs, $amount, $date, $currency, $tokenPrice)
	{
		$dateArr = [];
		$tokenAmount = 0;

		foreach ($curs as $c) {
			if (!in_array($c->timestamp, $dateArr)) {
				$dateArr[] = (int)$c->timestamp;
			}
		}

		$closetDate = $this->getClosest((int)$date, $dateArr);

		foreach ($curs as $c) {
			if ((int)$c->timestamp == $closetDate) {
				switch ($currency) {
					case 'ETH':
						if ($c->pair == 'ETH/USD') {
							$tokenAmount = $amount * $c->price / $tokenPrice;
						}
						break;
					case 'BTC':
						if ($c->pair == 'BTC/USD') {
							$tokenAmount = $amount * $c->price / $tokenPrice;
						}
						break;
				}
			}
		}

		return round($tokenAmount, 2);
	}

	public function storeTx()
	{
		$tx = $this->getTransactions();
		$db = [];
		$curs = $this->bonusService->getLatestCurrencies();
		$tokenPrice = $this->bonusService->getTokenPrice();

		foreach ($tx as $t) {
			$txTimestamp = strtotime($t->date);
			$closest = null;

			$db[] = [
				'transaction_id' => $t->txId,
				'status' => $t->status,
				'currency' => $t->currency,
				'from' => $t->from,
				'amount' => $t->amount,
				'amount_tokens' => $this->countTokens($curs, $t->amount, $t->date, $t->currency, $tokenPrice),
				'date' => $t->date
			];

			for ($i = 0; $i < count($db); $i++) {
				if (!Transactions::where('transaction_id', '=', $db[$i]['transaction_id'])->exists()) {
					Transactions::create($db[$i]);
				}
			}
		}
		return $db;
	}

	public function getWalletTx($wallet)
	{
		return Transactions::where('from', $wallet)->get();
	}

	public function setDataForMyTx()
	{
		$currenUserWallets = $this->walletService->getCurrentWallets();


	}
}