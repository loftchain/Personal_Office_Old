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
		$adminReferrals = UserReferralFields::all();

		$request->session()->forget('reset_password_email');
		$time = is_numeric(Input::get('time')) ? Input::get('time') : time();
        
        $currTime = \DateTime::createFromFormat('U', $time);
        if ($currTime < \DateTime::createFromFormat('U', env('ICO_START'))) {
            $data['stage'] = 0;
            $data['timerBegin'] = 0;
            $data['timerCurrent'] = $time;
            $data['timerEnd'] = env('ICO_START');
            $data['stageBegin'] = '';
            $data['stageEnd'] = \DateTime::createFromFormat('U', env('ICO_START'))->format('d.m.Y');
            $data['stageLabel'] = 'ICO';
            $data['stageTitle'] = Lang::get('home/widget.beforeStart_js') . ' ' . $data['stageLabel'];
        } else if ($currTime < \DateTime::createFromFormat('U', env('ICO_END'))) {
            $data['stage'] = 1;
            $data['timerBegin'] = env('ICO_START');
            $data['timerCurrent'] = $time;
            $data['timerEnd'] = env('ICO_END');
            $data['stageBegin'] = \DateTime::createFromFormat('U', env('ICO_START'))->format('d.m.Y');
            $data['stageEnd'] = \DateTime::createFromFormat('U', env('ICO_END'))->format('d.m.Y');
            $data['stageLabel'] = 'ICO';
            $data['stageTitle'] = Lang::get('home/widget.beforeEnd_js') . ' ' . $data['stageLabel'];
        } else {
            $data['stage'] = 2;
            $data['timerBegin'] = 0;
            $data['timerCurrent'] = 0;
            $data['timerEnd'] = 0;
            $data['stageBegin'] = '';
            $data['stageEnd'] = '';
            $data['stageLabel'] = 'ICO';
            $data['stageTitle'] = Lang::get('home/widget.crowdSaleFinished_js');
        }
        
		$data['btcCurrentAmount'] = $this->widgetService->calcCurrentCryptoAmount('BTC', 'BTC/ETH');
		$data['ethCurrentAmount'] = $this->widgetService->calcCurrentCryptoAmount('ETH', 'ETH/ETH');
		$data['totalUSDCollected'] = $data['btcCurrentAmount']['currency'] * $this->widgetService->getCurrencyByPair('BTC/USD') + $data['ethCurrentAmount']['currency'] * $this->widgetService->getCurrencyByPair('ETH/USD');
		$data['stageInfo'] = $this->bonusService->getStageInfo();
		$data['time'] = $time;
		$data['authenticated'] = Auth::check();
		$data['confirmed'] = $user->confirmed;
		$data['admin'] = $user->admin;
		$data['referrals'] = $this->referralService->getReferralData();
		$data['adminReferrals'] = $adminReferrals;
		//$data['sn'] = $this->transactionService->storeTx(); //Пересчёт токенов, по сути, запускается при каждом входе на страницу /home. ЭТО ТОЧНО НЕОБХОДИМО?
		return view('home.home')->with('data', $data);

	}

	public function welcome()
	{
		return view('home.welcome');
	}

}
