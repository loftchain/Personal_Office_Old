<?php

namespace App\Http\Controllers;

use App\Models\UserReferralFields;
use App\Services\ReferralService;
use App\Services\TransactionService;
use App\Services\BonusService;
use App\Services\WidgetService;
use App\Services\WalletService;
use App\Models\User;
use App\Models\UserWalletFields;
use App\Models\UserPersonalFields;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ICOAPI;

class HomeController extends Controller
{

	protected $widgetService;
	protected $walletService;
	protected $transactionService;
	protected $referralService;
	protected $bonusService;


	public function __construct(
		WidgetService $widgetService,
		WalletService $walletService,
		TransactionService $transactionService,
		ReferralService $referralService,
		BonusService $bonusService
	)
	{
		$this->middleware('valid', ['except' => ['welcome']]);
		$this->walletService = $walletService;
		$this->widgetService = $widgetService;
		$this->transactionService = $transactionService;
		$this->referralService = $referralService;
		$this->bonusService = $bonusService;
	}

	public function home(Request $request)
	{
		$data = [];
		$user = User::find(Auth::id());
		$adminReferrals = UserReferralFields::all();

		$request->session()->forget('reset_password_email');
		$time = is_numeric(Input::get('time')) ? Input::get('time') : time();
		$data['btcCurrentAmount'] = $this->widgetService->calcCurrentCryptoAmount('BTC', 'BTC/ETH');
		$data['ethCurrentAmount'] = $this->widgetService->calcCurrentCryptoAmount('ETH', 'ETH/USD');
		$data['totalCryptoAmount'] = array_map(function () {
			return array_sum(func_get_args());
		}, $data['btcCurrentAmount'], $data['ethCurrentAmount']);

		$data['totalCryptoAmountUSD'] = $this->widgetService->recountFiatToETH();
		$data['stageInfo'] = $this->bonusService->getStageInfo();
		$data['time'] = $time;
		$data['authenticated'] = Auth::check();
		$data['confirmed'] = $user->confirmed;
		$data['admin'] = $user->admin;
		$data['referrals'] = $this->referralService->getReferralData();
//		Log::info($data['referrals']);
		$data['adminReferrals'] = $adminReferrals;

		return view('home.home')->with('data', $data);

	}

	public function welcome()
	{
		return view('home.welcome');
	}

}
