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


	public function getStageInfo()
	{
		$time = is_numeric(Input::get('time')) ? Input::get('time') : time();
		$stageData = [];
		switch (true) {
			case $time <= env('1_BONUS_24h'):
				$stageData = ['bonus<10' => 20, 'bonus10-100' => 22.5, 'bonus100+' => 25];
				break;
			case $time > env('1_BONUS_24h') && $time <= env('2_BONUS_1w'):
				$stageData = ['bonus<10' => 15, 'bonus10-100' => 17.5, 'bonus100+' => 20];
				break;
			case $time > env('2_BONUS_1w') && $time <= env('3_BONUS_2w'):
				$stageData = ['bonus<10' => 5, 'bonus10-100' => 7.5, 'bonus100+' => 10];
				break;
			case $time > env('3_BONUS_2w') && $time <= env('4_BONUS_3w'):
				$stageData = ['bonus<10' => 1, 'bonus10-100' => 1, 'bonus100+' => 1];
				break;
			case $time > env('4_BONUS_3w') && $time <= env('ICO_END'):
				$stageData = ['bonus<10' => 0, 'bonus10-100' => 0, 'bonus100+' => 0];
				break;
		}
		return $stageData;
	}
}