<?php

namespace App\Services;

use App\Helpers\ICOAPI;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\HomeController;
use GuzzleHttp\Client;
use App\Services\BonusService;


class WidgetService
{

	protected $bonusService;

	public function __construct(BonusService $bonusService)
	{
		$this->bonusService = $bonusService;
	}

	public function getTx()
	{
		$client = new Client();
		$res = $client->request('GET', env('SELF_API_URL') . '/api/tx/' . env('OWNER_ID'));
		$body = json_decode($res->getBody());
		return $body;
	}

	public function getCurrencyByPair($pair)
	{
		$currency = $this->bonusService->getLatestCurrencies();
		$price = 0;
		foreach ($currency as $c) {
			if ($c->pair == $pair) {
				$price = $c->price;
			}
		}
		return $price;
	}

	public function calcCurrentCryptoAmount($currency, $pair)
	{
		$tx = $this->getTx();
		$amountCurrency = 0;
		$amountUsd = 0;
		$amountToken = 0;
		$stageInfo = $this->bonusService->getStageInfo();

		foreach ($tx as $t) {
			if($t->status == 'true'){
				if ($t->currency == $currency) {
					$amountCurrency += $t->amount;
				}
			}
		}

		$amountETH = ($currency == 'ETH') ? $amountCurrency : $amountCurrency * $this->getCurrencyByPair($pair);
		$amountToken = $amountETH;
		return ['currency' => $amountCurrency, 'eth' => $amountETH, 'token' => $amountToken];
	}

	public function recountFiatToETH(){
		$ethUsd = $this->getCurrencyByPair('ETH/USD');
		$convertedValue = env('INVESTED_IN_USD') / $ethUsd;
		return $convertedValue;
	}
}