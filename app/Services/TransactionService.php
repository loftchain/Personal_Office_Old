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

	public function appliedBonus($amountETH){

		$stageInfo = $this->bonusService->getStageInfo();
		$discount = 0;

		switch(true){
			case $amountETH >= env('BONUS_THRESHOLD1') && $amountETH < env('BONUS_THRESHOLD2'):
				$discount = $stageInfo['bonus1'];
				break;
			case $amountETH >= env('BONUS_THRESHOLD2') && $amountETH < env('BONUS_THRESHOLD3'):
				$discount = $stageInfo['bonus2'];
				break;
			case $amountETH >= env('BONUS_THRESHOLD3') && $amountETH < env('BONUS_THRESHOLD4'):
				$discount = $stageInfo['bonus3'];
				break;
			case $amountETH >= env('BONUS_THRESHOLD4'):
				$discount = $stageInfo['bonus4'];
				break;
		}
			return $discount/100;
	}

	public function sumBonusAndTokens($tokenAmount, $amountETH){
		$discount = $this->appliedBonus($amountETH);
		$bonus = $tokenAmount * $discount;
		return $tokenAmount + $bonus;
	}

	public function countTokens($rates, $amount, $date, $currency, $tokenPrice)
	{
		$dateArr = [];
		$totalTokenAmount = 0;
		foreach ($rates as $r) {
			if (!in_array($r->timestamp, $dateArr)) {
				$dateArr[] = (int)$r->timestamp;
			}
		}

		$closetDate = $this->getClosest((int)$date, $dateArr);


		foreach ($rates as $r) {
			if ((int)$r->timestamp == $closetDate) {
				switch ($currency) {
					case 'ETH':
						$tokenAmount = $amount * $tokenPrice;
						$totalTokenAmount = $this->sumBonusAndTokens($tokenAmount, $amount);
						break;
					case 'BTC':
						if ($r->pair === 'BTC/ETH') {
							$amountETH = $amount * $r->price;
							$tokenAmount = $amountETH * $tokenPrice;
							$totalTokenAmount = $this->sumBonusAndTokens($tokenAmount, $amountETH);
						}
						break;
				}
			}
		}

		return round($totalTokenAmount, 2);
	}

	public function storeTx()
	{
		$tx = $this->getTransactions();
		$db = [];
		$rates = $this->bonusService->getLatestCurrencies();
		$stageInfo = $this->bonusService->getStageInfo();

		foreach ($tx as $t) {
			$txTimestamp = strtotime($t->date);
			$closest = null;
			$info = ($t->currency == 'ETH') ? 'etherscan.io' : 'blockchain.info';

			$db[] = [
				'transaction_id' => $t->txId,
				'status' => $t->status,
				'currency' => $t->currency,
				'from' => $t->from,
				'amount' => $t->amount,
				'amount_tokens' => $this->countTokens($rates, $t->amount, $t->date, $t->currency, $stageInfo['tokenPriceInETH']),
				'info' => $info,
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

	public function getDataForMyTx()
	{
		$txData = [];
		$currentUserWallets = $this->walletService->getCurrentWallets();

		foreach ($currentUserWallets as $wallet) {
			if($wallet->type != 'to'){
				$tx = Transactions::where('from', $wallet->wallet)->get();
				$txData[] = ['wallet' => [$wallet->wallet, $wallet->currency], 'tx' => $tx];
			}
		}

		return $txData;
	}

	public function getDataForAdminTx()
	{
		$tx = Transactions::all();
		return $tx;
	}
}