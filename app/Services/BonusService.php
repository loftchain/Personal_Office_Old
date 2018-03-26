<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\HomeController;

class BonusService
{

	public function getLatestCurrencies()
	{
		$client = new Client();
		$res = $client->request('GET', env('SELF_API_URL') . '/api/currencies/');
		$body = json_decode($res->getBody());
		return $body;
	}

	public function getTokenPrice($now){
		$tokenPriceInUsd = [0.8,1,1.25,1.5,1.75];
		$tokenPrice = 0;

		switch (true) {
			case $now < 1522368000:
				$tokenPrice = $tokenPriceInUsd[0];
				break;
		}
		0.000098 btc
	}

}