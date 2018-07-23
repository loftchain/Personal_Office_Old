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

	public function storeRefsToDbForAdmin()
	{
		UserReferralFields::truncate();

		$singleRefArray = [];
		$referals = User::where('referred_by', '!=', null)->get();
		foreach ($referals as $ref) {
			$referredWallets = UserWalletFields::where('user_id', $ref->id)->get();
			if ($referredWallets) {
				foreach ($referredWallets as $rw) {
					$transactions = Transactions::where('from', $rw->wallet)->get();
					foreach ($transactions as $tx) {
						if($tx) {
							$singleRefArray[] =   ['ref_owner_id' => $ref->referred_by,
																		 'refs' => [
																		 	 'id' => $ref->id,
																			 'tokens' => $tx->amount_tokens
																		 ]
																		];
						}
					}
				}
			}
		}

		foreach ($singleRefArray as $k => $v){
			$id = $v['ref_owner_id'];
			$result[$id][] = $v['refs']['tokens'];
		}

		foreach($result as $key => $value) {
			$wallets = UserWalletFields::where('user_id', $key)->first();
			if ($wallets->type === 'from_to' || $wallets->type === 'to') {
				$finalReferralSumm[] = array('id' => $key, 'wallet' => $wallets->wallet, 'token_sum' => array_sum($value)*0.05);
			}
		}

		foreach ($finalReferralSumm as $frs){
			UserReferralFields::create([
				'user_id' =>  $frs['id'],
				'wallet_to' => $frs['wallet'],
				'tokens'   => $frs['token_sum']
			]);
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
			if (isset($referralData['stat'])) {
				foreach ($referralData['stat'] as $item) {
					if (isset($item['tokens'])) {
						$total += $item['token_sum'];
					}
				}
			}

			$referralData['tokens_total'] = $total;
			//------------------------------------------------

		}
		return $referralData;

	}

}