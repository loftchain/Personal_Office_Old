<?php

namespace App\Services;

use App\Helpers\ICOAPI;
use App\Models\Transactions;
use App\Models\User;
use App\Models\UserWalletFields;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\HomeController;
use GuzzleHttp\Client;
use App\Services\BonusService;


class ReferralService
{

	protected $bonusService;
	protected $walletService;

	public function __construct(BonusService $bonusService, WalletService $walletService)
	{
		$this->bonusService = $bonusService;
		$this->walletService = $walletService;
	}

	public function getReferralData(){
		$referralData = [];

		if(Auth::user()){
			$myReferrals = User::where('referred_by', Auth::user()->id)->get();
			foreach ($myReferrals as $mr){
				$uwf = UserWalletFields::where('user_id', $mr->id)->get();
				foreach ($uwf as $item){
					if($item->type === 'from_to' || $item->type === 'to'){
						$referralData['wallets_to'][] = $item['wallet'];
					}
				}
			}
		}

		Log::info($referralData);

	}

}