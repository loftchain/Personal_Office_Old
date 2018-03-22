<?php

namespace App\Http\Controllers;

use App\Services\WidgetService;
use App\Models\User;
use App\Models\UserWalletFields;
use App\Models\UserPersonalFields;
use App\Services\Lk\LinksService;
use App\Services\Lk\TransactionsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ICOAPI;

class HomeController extends Controller
{

	public function __construct()
	{
		$this->middleware('valid', ['except' => ['welcome']]);
	}

	public function get_period($time)
	{
		$period = []; //current stage, next stage

		switch (true) {
			case $time >= env('PRE_ICO_START') && $time < env('PRE_ICO_END'):
				$difference = env('PRE_ICO_END') - env('PRE_ICO_START');
				$period = ['pre_ico', 'out', $difference];
				break;
			case $time >= env('ICO_START') && $time < env('ICO_END'):
				$difference = env('ICO_END') - env('ICO_START');
				$period = ['ico', 'out', $difference];
				break;
			case $time < env('PRE_ICO_START'):
				$difference = env('PRE_ICO_START') - time();
				$period = ['out', 'pre-ico', $difference];
				break;
			case $time < env('ICO_START'):
				$difference = env('ICO_START') - time();
				$period = ['out', 'ico', $difference];
				break;
			case $time > env('ICO_END'):
				$difference = null;
				$period = ['out', 'finish', $difference];
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

	protected function get_wallet_data()
	{
		$transactionsService = new TransactionsService();

		return $transactionsService->getUserTransactions(Auth::id());
	}

	public function welcome(Request $request)
	{
		$request->session()->forget('reset_password_email');
		$data = [];
		$time = is_numeric(Input::get('time')) ? Input::get('time') : time();
//		$walletFields = UserWalletFields::where('user_id', Auth::id())->first();
//
//		if ($walletFields) {
//			$walletFields['full_name_of_wallet_invest_from'] = $this->get_currency_name($walletFields['name_of_wallet_invest_from']);
//			$data['walletFields'] = $walletFields;
//		}
//
//		$data['data_tables'] = $this->get_data_tables();
//		$data['widget_data'] = $this->get_widget_data();
//
//
//		$data['transactions'] = $this->get_wallet_data();
		$data['period'] = $this->get_period($time);
		$data['time'] = $time;
//		$data['refs'] = $this->get_referals_data();
		return view('home.home')->with('data', $data);

	}

}
