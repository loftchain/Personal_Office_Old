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

	public function get_period($time)
	{
		$period = []; //current stage, next stage

		switch (true) {
			case $time >= env('PRE_ICO_START') && $time < env('PRE_ICO_END'):
				$period = ['pre_ico', 'out'];
				break;
			case $time >= env('ICO_START') && $time < env('ICO_END'):
				$period = ['ico', 'out'];
				break;
			case $time < env('PRE_ICO_START'):
				$period = ['out', 'pre_ico'];
				break;
			case $time < env('ICO_START'):
				$period = ['out', 'ico'];
				break;
			case $time > env('ICO_END'):
				$period = ['out', 'finish'];
				break;
		}
		return $period;
	}

	protected function get_currency_name($currency)
	{
		switch ($currency) {
			case 'ETH':
				$currency = 'Ethereum';
				break;
			case 'BTC':
				$currency = 'Bitcoin';
				break;
		}
		return $currency;
	}

	protected function get_token_amount(){

	}

	public function welcome(Request $request)
	{
		$request->session()->forget('reset_password_email');
		$data = [];
		$time = is_numeric(Input::get('time')) ? Input::get('time') : time();
		$data['btcCurrentAmount'] = $this->widgetService->calcCurrentCryptoAmount('BTC', 'BTC/USD');
		$data['ethCurrentAmount'] = $this->widgetService->calcCurrentCryptoAmount('ETH', 'ETH/USD');
		$data['totalCryptoAmount'] = array_map(function () {
			return array_sum(func_get_args());
		}, $data['btcCurrentAmount'], $data['ethCurrentAmount']);
		$data['period'] = $this->get_period($time);
		$data['time'] = $time;
		$data['authenticated'] = Auth::check();


		return view('home.welcome')->with('data', $data);

	}

	public function home(Request $request)
	{
		$user = User::find(Auth::id());
		$adminReferrals = UserReferralFields::all();

		$request->session()->forget('reset_password_email');
		$data = [];
		$time = is_numeric(Input::get('time')) ? Input::get('time') : time();
		$data['btcCurrentAmount'] = $this->widgetService->calcCurrentCryptoAmount('BTC', 'BTC/ETH');
		$data['ethCurrentAmount'] = $this->widgetService->calcCurrentCryptoAmount('ETH', 'ETH/USD');
		$data['totalCryptoAmount'] = array_map(function () {
			return array_sum(func_get_args());
		}, $data['btcCurrentAmount'], $data['ethCurrentAmount']);

		$data['stageInfo'] = $this->bonusService->getStageInfo();
		Log::info($data['stageInfo']);
		$data['time'] = $time;
		$data['authenticated'] = Auth::check();
		$data['confirmed'] = $user->confirmed;
		$data['admin'] = $user->admin;
		$data['referrals'] = $this->referralService->getReferralData();
		$data['adminReferrals'] = $adminReferrals;


		return view('home.home')->with('data', $data);

	}

}
