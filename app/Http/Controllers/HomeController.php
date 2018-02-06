<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Services\WidgetService;
use App\UserInformation;
use App\UserPersonalField;
use App\UserPersonalFields;
use App\UserWalletFields;
use App\Models\User;
use App\Traits\CaptchaTrait;
use App\Services\Lk\LinksService;
use App\Services\Lk\TransactionsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use View;
use App\Helpers\ICOAPI;

class HomeController extends Controller
{
  use CaptchaTrait;
  /**
   * Create a new controller instance.
   *
   * @return void
   */

  private $data;

  public function __construct()
  {
    $this->middleware('valid', ['except' => ['welcome']]);
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function get_period($time)
  {

    if ($time >= env('PRE_ICO_START') && $time < env('PRE_ICO_END')) {
      return 'pre_ico';
    } else if ($time >= env('ICO_START') && $time < env('ICO_END')) {
      return 'ico';
    } else {
      return 'out';
    }

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

  protected function get_referals_data()
  {

    $data = [];
    $linksService = new LinksService();

    $data['statistics'] = $linksService->userStatistics(Auth::id());
//    $data['links'] = $linksService->forUser(User::where('id', Auth::id())->first());
    $data['affiliate_id'] = $linksService->getUniqueAffiliate();

    return $data;
  }

  protected function get_links_view()
  {
    $data = [];
    $data['refs'] = $this->get_referals_data();
    return view('lk.referals.list')->with('data', $data);
  }

  public function get_widget_data()
  {
    $w = new WidgetService();
    return $w->getW();

  }

  protected function get_data_tables()
  {
    $ico = new ICOAPI(env('ICO_API_KEY'));
    $blocks = $ico->getBlock();

    return $blocks;
  }


  public function index()
  {

    Session::forget('reset_password_email');

    $data = [];
    $time = is_numeric(Input::get('time')) ? Input::get('time') : time();
    $walletFields = UserWalletFields::where('user_id', Auth::id())->first();

    if ($walletFields) {
      $walletFields['full_name_of_wallet_invest_from'] = $this->get_currency_name($walletFields['name_of_wallet_invest_from']);
      $data['walletFields'] = $walletFields;
    }

    $data['data_tables'] = $this->get_data_tables();
    $data['widget_data'] = $this->get_widget_data();


    $data['transactions'] = $this->get_wallet_data();
    $data['period'] = $this->get_period($time);
    $data['time'] = $time;
    $data['refs'] = $this->get_referals_data();

    return view('home.home')->with('data', $data);

  }

  public function welcome()
  {

    $data = [];
    $time = is_numeric(Input::get('time')) ? Input::get('time') : time();
    $walletFields = UserWalletFields::where('user_id', Auth::id())->first();

    if ($walletFields) {
      $walletFields['full_name_of_wallet_invest_from'] = $this->get_currency_name($walletFields['name_of_wallet_invest_from']);
      $data['walletFields'] = $walletFields;
    }

    $data['data_tables'] = $this->get_data_tables();
    $data['widget_data'] = $this->get_widget_data();


    $data['transactions'] = $this->get_wallet_data();
    $data['period'] = $this->get_period($time);
    $data['time'] = $time;
    $data['refs'] = $this->get_referals_data();

    return view('home.home')->with('data', $data);

  }

}
