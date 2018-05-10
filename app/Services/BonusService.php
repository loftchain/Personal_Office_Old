<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\HomeController;

class BonusService
{

	public function getLatestCurrencies($pair = null, $timestamp = null)
	{
		$client = new Client();
		$res = $client->request('GET', env('SELF_API_URL') . '/api/currencies/');
		$body = json_decode($res->getBody());
		foreach ($body as $item) {
			if ($item->pair == $pair && $item->timestamp == $timestamp) {
				return $item->price;
			} else if ($item->timestamp == $timestamp) {
				return $item->price;
			} else if ($item->pair == $pair) {
				return $item->price;
			}
		}

		return $body;
	}

	public function setStageDetails($currentStage, $nextStage,
	                                $softCapETH, $hardCapETH,
	                                $tokenPrice, $minPayment,
	                                $walletETH, $walletBTC,
	                                $b1, $b2, $b3, $b4
	)
	{
		$stageData['tokenPriceInETH'] = $tokenPrice;
		$stageData['softCapETH'] = $softCapETH;
		$stageData['hardCapETH'] = $hardCapETH;
		$stageData['softCapToken'] = $softCapETH * $tokenPrice;
		$stageData['hardCapToken'] = $hardCapETH * $tokenPrice;
		$stageData['minPayment'] = $minPayment;
		$stageData['currentStage'] = $currentStage;
		$stageData['nextStage'] = $nextStage;
		$stageData['walletETH'] = $walletETH;
		$stageData['walletBTC'] = $walletBTC;
		$stageData['bonus1'] = $b1;
		$stageData['bonus2'] = $b2;
		$stageData['bonus3'] = $b3;
		$stageData['bonus4'] = $b4;
		return $stageData;
	}

	public function getStageInfo()
	{
		$stageData = [];
		switch (true) {
			case time() < env('PRE_SALE_START'):
				$stageData = $this->setStageDetails(
					null, 'pre_sale',
					env('PRE_SALE_SOFT_CAP'), env('PRE_SALE_HARD_CAP'),
					env('PRE_SALE_TOKEN_PRICE'), env('PRE_SALE_MIN_PAY'),
					env('PRE_SALE_WALLET_ETH'), env('PRE_SALE_WALLET_BTC'),
					env('PRE_SALE_BONUS1'), env('PRE_SALE_BONUS2'),
					env('PRE_SALE_BONUS3'), env('PRE_SALE_BONUS4')
				);
				break;
			case time() <= env('PRE_SALE_END'):
				$stageData = $this->setStageDetails(
					'pre_sale', 'pre_ico',
					env('PRE_SALE_SOFT_CAP'), env('PRE_SALE_HARD_CAP'),
					env('PRE_SALE_TOKEN_PRICE'), env('PRE_SALE_MIN_PAY'),
					env('PRE_SALE_WALLET_ETH'), env('PRE_SALE_WALLET_BTC'),
					env('PRE_SALE_BONUS1'), env('PRE_SALE_BONUS2'),
					env('PRE_SALE_BONUS3'), env('PRE_SALE_BONUS4')
				);
				break;
			case time() > env('PRE_ICO_START') && time() <= env('PRE_ICO_END'):
				$stageData = $this->setStageDetails(
					'pre_ico', 'ico1',
					env('PRE_ICO_SOFT_CAP'), env('PRE_ICO_HARD_CAP'),
					env('PRE_ICO_TOKEN_PRICE'), env('PRE_ICO_MIN_PAY'),
					env('PRE_ICO_WALLET_ETH'), env('PRE_ICO_WALLET_BTC'),
					env('PRE_ICO_BONUS1'), env('PRE_ICO_BONUS2'),
					env('PRE_ICO_BONUS3'), env('PRE_ICO_BONUS4')
				);
				break;
			case time() > env('ICO1_START') && time() <= env('ICO1_END'):
				$stageData = $this->setStageDetails(
					'ico1', 'ico2',
					env('ICO1_SOFT_CAP'), env('ICO1_HARD_CAP'),
					env('ICO1_TOKEN_PRICE'), env('ICO1_MIN_PAY'),
					env('ICO1_WALLET_ETH'), env('ICO1_WALLET_BTC'),
					env('ICO1_BONUS1'), env('ICO1_BONUS2'),
					env('ICO1_BONUS3'), env('ICO1_BONUS4')
				);
				break;
			case time() > env('ICO2_START') && time() <= env('ICO2_END'):
				$stageData = $this->setStageDetails(
					'ico2', 'ico3',
					env('ICO2_SOFT_CAP'), env('ICO2_HARD_CAP'),
					env('ICO2_TOKEN_PRICE'), env('ICO2_MIN_PAY'),
					env('ICO2_WALLET_ETH'), env('ICO2_WALLET_BTC'),
					env('ICO2_BONUS1'), env('ICO2_BONUS2'),
					env('ICO2_BONUS3'), env('ICO2_BONUS4')
				);
				break;
			case time() > env('ICO3_START') && time() <= env('ICO3_END'):
				$stageData = $this->setStageDetails(
					'ico3', 'finish',
					env('ICO3_SOFT_CAP'), env('ICO3_HARD_CAP'),
					env('ICO3_TOKEN_PRICE'), env('ICO3_MIN_PAY'),
					env('ICO3_WALLET_ETH'), env('ICO3_WALLET_BTC'),
					env('ICO3_BONUS1'), env('ICO3_BONUS2'),
					env('ICO3_BONUS3'), env('ICO3_BONUS4')
				);
				break;
		}
		return $stageData;
	}

}