<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\HomeController;

class BonusService
{

	public function getLatestCurrencies($pair, $timestamp)
	{
		$client = new Client();
		$res = $client->request('GET', env('SELF_API_URL') . '/api/currencies/');
		$body = json_decode($res->getBody());
		foreach ($body as $item) {
			if($item->pair == $pair){
				return $item->price;
			}
		}
		return $body;
	}

	public function getTokenPrice()
	{
		$tokenPriceInUsd = [0.8, 1, 1.25, 1.5, 1.75];
		$thresholdDate = [1522368000, 1522886400, 1524700799, 1526342400, 1529107199];
		$tokenPrice = 0;

		switch (true) {
			case time() < $thresholdDate[0]:
				$tokenPrice = $tokenPriceInUsd[0];
				break;
			case time() > $thresholdDate[0] && time() < $thresholdDate[1]:
				$tokenPrice = $tokenPriceInUsd[1];
				break;
			case time() > $thresholdDate[1] && time() < $thresholdDate[2]:
				$tokenPrice = $tokenPriceInUsd[2];
				break;
			case time() > $thresholdDate[2] && time() < $thresholdDate[3]:
				$tokenPrice = $tokenPriceInUsd[3];
				break;
			case time() < $thresholdDate[4]:
				$tokenPrice = $tokenPriceInUsd[4];
				break;
		}
		return $tokenPrice;
	}

}