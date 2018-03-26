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
		$res = $client->request('GET', env('SELF_API_URL') . '/api/tx/' . env('CUSTOMER_ID'));
		$body = json_decode($res->getBody());
		return $body;
	}

	public function getCurrencyByPair($pair)
	{

		$currency = $this->bonusService->getLatestCurrencies();
		$price = 0;

		foreach ($currency as $c){
			if ($c->pair == $pair) {
				$price = $c->price;
			}
		}

		return $price;

	}

	public function calcSoftCap($currency)
	{
		$tx = $this->getTx();
		$amountCurrency = $amountUsd = $amountToken = 0;

		foreach ($tx as $t) {
			if ($t->currency == $currency) {
				$amountCurrency += $t->amount;
			}
		}

		switch ($currency) {
			case 'BTC':
				$amountUsd = $amountCurrency * $this->getCurrencyByPair('BTC/USD');
				break;
			case 'ETH':
				$amountUsd = $amountCurrency * $this->getCurrencyByPair('ETH/USD');
				break;
		}

		return ['currency' => $amountCurrency, 'usd' => $amountUsd, ];
	}


}