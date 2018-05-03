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
		$myReferrals = User::where('referred_by', Auth::user()->id)->get();
		Log::info($myReferrals);
		//TODO:Collect token bonuses from theirs transactions
	}

}