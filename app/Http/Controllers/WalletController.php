<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use App\Models\UserHistoryFields;
use App\Models\UserWalletFields;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use ReCaptcha\ReCaptcha;

class WalletController extends Controller
{

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
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

	  return response()->json(['wallet_added' => 'Wallet was successfully added']);
  }

  public function store_wallet_data(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'wallet_invest_from' => 'required|string|min:25|max:45|unique_wallet',
      'wallet_get_tokens' => 'required|string|min:25|max:45|unique_wallet',
    ]);
    if ($validator->fails()) {
      return response()->json(['validation_error'=>$validator->errors()]);
    }
    $request[$request['name_of_wallet_invest_from']] = $request['wallet_invest_from'];
    $wallet = $this->create($request->all())->toArray();
    $this->wallet_history_make('store wallet', $wallet, null);

    return response()->json(['status', Lang::get('controller/mycrypto.message_0')]);
  }

  public function update_wallet_data(Request $request)
  {
    $request['captcha'] = $this->captchaCheck();
    $validator = Validator::make($request->all(), [
      'wallet_invest_from' => 'required|string|min:25|max:45|unique_wallet_update',
      'wallet_get_tokens' => 'required|string|min:25|max:45|unique_wallet_update',
      'password' => 'required|string|min:3',
      'g-recaptcha-response'  => 'required'
    ]);
    if ($validator->fails()) {
      return response()->json(['validation_error'=>$validator->errors()]);
    }

    $walletData = UserWalletFields::where('user_id', Auth::id())->first();
    $user = User::where('id', Auth::id())->first();
    $passwordIsVerified = password_verify( $request['password'], $user->password );
    if (!$passwordIsVerified) {
      $validator->getMessageBag()->add('password', Lang::get('controller/mycrypto.message_2'));
      return response()->json(['validation_error' => $validator->errors()]);
    }

    $walletData->wallet_invest_from = $request['wallet_invest_from'];
    $walletData[$request['name_of_wallet_invest_from']] = $request['wallet_invest_from'];
    $walletData->name_of_wallet_invest_from = $request['name_of_wallet_invest_from'];
    $walletData->wallet_get_tokens = $request['wallet_get_tokens'];
    $walletData->save();

    @$user_history = UserHistoryFields::where('user_id', Auth::id())->first();
    $this->wallet_history_make('update wallet', $walletData, $user_history);
    return response()->json(['status', Lang::get('controller/mycrypto.message_1')]);
  }

  public function current_wallets(Request $request){
    $walletData = UserWalletFields::where('user_id', Auth::id())->get();
    return response()->json(['currentWallets' => $walletData]);
  }

}
