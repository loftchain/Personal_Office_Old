<?php

namespace App\Http\Controllers;

use App\Mail\SendFiatRequest;
use App\Models\User;
use App\Models\UserPersonalFields;
use App\Services\WalletService;
use App\Services\WidgetService;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use App\Models\UserHistoryFields;
use App\Models\UserWalletFields;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use ReCaptcha\ReCaptcha;

class WalletController extends Controller
{

  protected $walletService;

  public function __construct(WalletService $walletService)
  {
  	$this->walletService = $walletService;
    $this->middleware('valid');

  }

	  protected function create(array $data)
  {
	  return UserWalletFields::create([
      'user_id' => Auth::id(),
      'currency' => $data['currency'],
      'type' => $data['type'],
      'wallet' => $data['wallet'],
    ]);
  }

  protected function wallet_history_make($method, $wallet, $history){
    if($method == 'store wallet'){

      $h = [
        'wallet_currency_new' => $wallet['name_of_wallet_invest_from'],
        'wallet_invest_from_new' => $wallet['wallet_invest_from'],
        'wallet_get_tokens_new' => $wallet['wallet_get_tokens'],
        'update_wallet_at' => Carbon::now()
      ];

      UserHistoryFields::where('user_id', Auth::id())->update($h);
    } else {

      $uh = [
        'wallet_currency_old' => $history['wallet_currency_new'],
        'wallet_currency_new' => $wallet['name_of_wallet_invest_from'],
        'wallet_invest_from_old' => $history['wallet_invest_from_new'],
        'wallet_invest_from_new' => $wallet['wallet_invest_from'],
        'wallet_get_tokens_old' => $history['wallet_get_tokens_new'],
        'wallet_get_tokens_new' => $wallet['wallet_get_tokens'],
        'update_wallet_at' => Carbon::now()
      ];

      UserHistoryFields::where('user_id', Auth::id())->update($uh);

    }
  }

  public function store_wallet(Request $request) {
	  $validator = Validator::make($request->all(), [
		  'wallet' => 'required|string|min:25|max:45|unique:user_wallet_fields',
	  ]);
	  if ($validator->fails()) {
		  return response()->json(['validation_error'=>$validator->errors()]);
	  }

	  $wallet = $this->create($request->all());
	  $wallet->active = '1';
	  $wallet->save();

	  return response()->json(['wallet_added' => 'Wallet was successfully added', 'currency' => $wallet->currency]);
  }

  public function current_wallets(Request $request){
	$user = User::find(Auth::id());
	$walletData = ($user->confirmed == '1') ? $this->walletService->getCurrentWallets() : '';
    return response()->json(['currentWallets' => $walletData]);
  }

	public function description_view($currency){
		return view('home.wallet_help.description')->with('currency', $currency);
	}

	public function send_usd_proposal(Request $request){

		$user = User::find(Auth::id());
		$userPersonal = UserPersonalFields::where('user_id', Auth::id())->first();
		$wallet = UserWalletFields::where('user_id', Auth::id())->where('type', 'to')->first();

		$mailData = [
			'email' => $user->email,
			'name' => $userPersonal->name_surname,
			'address' => $userPersonal->permanent_address,
			'phone' => $userPersonal->contact_number,
			'sourceOfFunds' => $userPersonal->source_of_funds,
			'wallet' => $wallet->wallet,
			'amount' => $request['usdAmount'],
		];

		Mail::to(env('OWNER_EMAIL'))->send(new SendFiatRequest($mailData));
		return response()->json(['usd_request_sent' => 'good']);

	}

}
