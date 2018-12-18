<?php

namespace App\Services;

use App\Helpers\ICOAPI;
use App\Models\TempCurrency;
use App\Models\TempTransaction;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HomeController;
use App\Services\BonusService;
use GuzzleHttp\Client;


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
        $currency = TempCurrency::all();
        
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
        $tx = TempTransaction::all();
		$amountCurrency = 0;
		$amountUsd = 0;
		$amountToken = 0;

		foreach ($tx as $t) {
				if ($t->currency == $currency) {
					$amountCurrency += $t->amount;
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
    
    public function getUserByWallet($wallet) {
        $user = DB::table('users')
            ->select('users.id', 'users.referred_by')
            ->join('user_wallet_fields', 'user_wallet_fields.user_id', '=', 'users.id')
            ->where('user_wallet_fields.wallet', '=', $wallet)
            ->where('user_wallet_fields.type', 'like', '%from%')
            ->first();
        
        return $user ?? null;
    }
}