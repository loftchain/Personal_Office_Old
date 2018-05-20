<?php

namespace App\Services;

use App\Helpers\ICOAPI;
use App\Models\Transactions;
use App\Models\User;
use App\Models\UserReferralFields;
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

	public function storeRefsToDb($referralData){
		if(isset($referralData['wallets_to'][0])){
			for ($i = 0; $i < count($referralData); $i++) {
				if (!UserReferralFields::where('user_id', '=', Auth::user()->id)->exists()) {
					UserReferralFields::create([
						'user_id' =>  Auth::user()->id,
						'wallet_to' => $referralData['wallets_to'][0],
						'tokens'   => $referralData['tokens_total']
					]);
				}
			}
		}
	}

	public function getReferralData()
	{
		$referralData = [];
		$total = 0;
		if (Auth::user()->admin == 0) {
			$myReferrals = User::where('referred_by', Auth::user()->id)->get();
			//----------------------wallets_to-----------------
			$myUwf = UserWalletFields::where('user_id', Auth::user()->id)->get();
			foreach ($myUwf as $item) {
				if ($item->type === 'from_to' || $item->type === 'to') {
					$referralData['wallets_to'][] = $item['wallet'];
				}
			}
			//------------------------------------------------

			foreach ($myReferrals as $mr) {
				//----------------------emails--------------------
				$uwf = UserWalletFields::where('user_id', $mr->id)->get();
				//------------------------------------------------

				//----------------------wallets_from-----------------
				foreach ($uwf as $item) {
					if ($item->type === 'from_to' || $item->type === 'from') {
						$referralData['stat'][$mr['email']]['wallets_from'][] = $item['wallet'];

						//----------------------tokens---------------------
						$transactions = Transactions::where('from', $item['wallet'])->get();
						foreach ($transactions as $txs) {
							if ($txs->status === 'true') {
								$referralData['stat'][$mr['email']]['tokens'][] = $txs['amount_tokens'] * 0.05;  //5%
								$token_sum = array_sum($referralData['stat'][$mr['email']]['tokens']);
								$referralData['stat'][$mr['email']]['token_sum'] = $token_sum;
							}
						}
					}
				}
				//------------------------------------------------
			}
			//----------------------token_sum---------------------
			if(isset($referralData['stat'])){
				foreach ($referralData['stat'] as $item) {
					if(isset($item['tokens'])) {
						$total += $item['token_sum'];
					}
				}
			}

		$referralData['tokens_total'] = $total;
		//------------------------------------------------
		$this->storeRefsToDb($referralData);

		}
		return $referralData;

	}

}