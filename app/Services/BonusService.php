<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\HomeController;
use Lang;

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
        $currTime = \DateTime::createFromFormat('U', $time);
		$stageData = [];
        
        if ($currTime < \DateTime::createFromFormat('U', env('ICO_START'))) {
            $stageData['stage'] = 0;
            $stageData['timerBegin'] = 0;
            $stageData['timerCurrent'] = $time;
            $stageData['timerEnd'] = env('ICO_START');
            $stageData['stageBegin'] = '';
            $stageData['stageEnd'] = \DateTime::createFromFormat('U', env('ICO_START'))->format('d.m.Y');
            $stageData['stageLabel'] = 'ICO';
            $stageData['stageTitle'] = Lang::get('home/widget.beforeStart_js') . ' ' . $stageData['stageLabel'];
            $stageData['bonus<10'] = 0;
            $stageData['bonus10-100'] = 0;
            $stageData['bonus100+'] = 0;
        } else if ($currTime < \DateTime::createFromFormat('U', env('ICO_END'))) {
            $stageData['stage'] = 1;
            $stageData['timerBegin'] = env('ICO_START');
            $stageData['timerCurrent'] = $time;
            $stageData['timerEnd'] = env('ICO_END');
            $stageData['stageBegin'] = \DateTime::createFromFormat('U', env('ICO_START'))->format('d.m.Y');
            $stageData['stageEnd'] = \DateTime::createFromFormat('U', env('ICO_END'))->format('d.m.Y');
            $stageData['stageLabel'] = 'ICO';
            $stageData['stageTitle'] = Lang::get('home/widget.beforeEnd_js') . ' ' . $stageData['stageLabel'];
            
            switch (true) {
                case $time <= env('1_BONUS_24h'):
                    $stageData['bonus<10'] = 20;
                    $stageData['bonus10-100'] = 22.5;
                    $stageData['bonus100+'] = 25;
                    break;
                case $time > env('1_BONUS_24h') && $time <= env('2_BONUS_1w'):
                    $stageData['bonus<10'] = 15;
                    $stageData['bonus10-100'] = 17.5;
                    $stageData['bonus100+'] = 20;
                    break;
                case $time > env('2_BONUS_1w') && $time <= env('3_BONUS_2w'):
                    $stageData['bonus<10'] = 5;
                    $stageData['bonus10-100'] = 7.5;
                    $stageData['bonus100+'] = 10;
                    break;
                case $time > env('3_BONUS_2w') && $time <= env('4_BONUS_3w'):
                    $stageData['bonus<10'] = 1;
                    $stageData['bonus10-100'] = 1;
                    $stageData['bonus100+'] = 1;
                    break;
                case $time > env('4_BONUS_3w'):
                    $stageData['bonus<10'] = 0;
                    $stageData['bonus10-100'] = 0;
                    $stageData['bonus100+'] = 0;
                    break;
            }
        } else {
            $stageData['stage'] = 2;
            $stageData['timerBegin'] = 0;
            $stageData['timerCurrent'] = 0;
            $stageData['timerEnd'] = 0;
            $stageData['stageBegin'] = '';
            $stageData['stageEnd'] = '';
            $stageData['stageLabel'] = 'ICO';
            $stageData['stageTitle'] = Lang::get('home/widget.crowdSaleFinished_js');
            $stageData['bonus<10'] = 0;
            $stageData['bonus10-100'] = 0;
            $stageData['bonus100+'] = 0;
        }
        
		return $stageData;
	}
}