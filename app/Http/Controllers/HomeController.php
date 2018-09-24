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
use Lang;

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

		$request->session()->forget('reset_password_email');
        
		$data['time'] = is_numeric(Input::get('time')) ? Input::get('time') : time();
		$data['btcCurrentAmount'] = $this->widgetService->calcCurrentCryptoAmount('BTC', 'BTC/ETH');
		$data['ethCurrentAmount'] = $this->widgetService->calcCurrentCryptoAmount('ETH', 'ETH/ETH');
		$data['totalUSDCollected'] = $data['btcCurrentAmount']['currency'] * $this->widgetService->getCurrencyByPair('BTC/USD') + $data['ethCurrentAmount']['currency'] * $this->widgetService->getCurrencyByPair('ETH/USD');
        $data = array_merge($data, $this->bonusService->getStageInfo());
		$data['authenticated'] = Auth::check();
		$data['confirmed'] = $user->confirmed;
		$data['admin'] = $user->admin;
		$data['referrals'] = $this->referralService->getReferralData();
		$data['adminReferrals'] = UserReferralFields::all();
		//$data['sn'] = $this->transactionService->storeTx(); //Пересчёт токенов, по сути, запускается при каждом входе на страницу /home. ЭТО ТОЧНО НЕОБХОДИМО?
		return view('home.home')->with('data', $data);

	}

	public function welcome()
	{
		return view('home.welcome');
	}

}
