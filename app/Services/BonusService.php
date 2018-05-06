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

	public function setStageDetails($currentStage, $nextStage, $softCapETH, $hardCapETH, $tokenPrice, $minPayment)
	{
		$stageData['tokenPriceInETH'] = $tokenPrice;
		$stageData['softCapETH'] = $softCapETH;
		$stageData['hardCapETH'] = $hardCapETH;
		$stageData['softCapToken'] = $softCapETH * $tokenPrice;
		$stageData['hardCapToken'] = $hardCapETH * $tokenPrice;
		$stageData['minPayment'] = $minPayment;
		$stageData['currentStage'] = $currentStage;
		$stageData['nextStage'] = $nextStage;
		return $stageData;
	}

	public function getStageInfo()
	{
		$stageData = [];
		switch (true) {
			case time() < env('PRE_SALE_START'):
				$stageData = $this->setStageDetails(null, 'PRE SALE',env('PRE_SALE_SOFT_CAP'), env('PRE_SALE_HARD_CAP'), env('PRE_SALE_TOKEN_PRICE'), env('PRE_SALE_MIN_PAY'));
				break;
			case time() <= env('PRE_SALE_END'):
				$stageData = $this->setStageDetails('PRE SALE', 'PRE ICO',env('PRE_SALE_SOFT_CAP'), env('PRE_SALE_HARD_CAP'), env('PRE_SALE_TOKEN_PRICE'), env('PRE_SALE_MIN_PAY'));
				break;
			case time() > env('PRE_ICO_START') && time() <= env('PRE_ICO_END'):
				$stageData = $this->setStageDetails('PRE ICO', 'ICO 1', env('PRE_ICO_SOFT_CAP'), env('PRE_ICO_HARD_CAP'), env('PRE_ICO_TOKEN_PRICE'), env('PRE_ICO_MIN_PAY'));
				break;
			case time() > env('ICO1_START') && time() <= env('ICO1_END'):
				$stageData = $this->setStageDetails('ICO 1', 'ICO 2', env('ICO1_SOFT_CAP'), env('ICO1_HARD_CAP'), env('ICO1_TOKEN_PRICE'), env('ICO1_MIN_PAY'));
				break;
			case time() > env('ICO2_START') && time() <= env('ICO2_END'):
				$stageData = $this->setStageDetails('ICO 2', 'ICO 3', env('ICO2_SOFT_CAP'), env('ICO2_HARD_CAP'), env('ICO2_TOKEN_PRICE'), env('ICO2_MIN_PAY'));
				break;
			case time() > env('ICO3_START') && time() <= env('ICO3_END'):
				$stageData = $this->setStageDetails('ICO 3', 'FINISH', env('ICO3_SOFT_CAP'), env('ICO3_HARD_CAP'), env('ICO3_TOKEN_PRICE'), env('ICO3_MIN_PAY'));
				break;
		}
		return $stageData;
	}

}