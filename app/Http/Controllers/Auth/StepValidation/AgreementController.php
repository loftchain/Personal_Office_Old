<?php

namespace App\Http\Controllers\Auth\StepValidation;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPersonalFields;
use GuzzleHttp\Client;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AgreementController extends Controller
{

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function goToAgreement2()
	{
		$user = User::find(Auth::id());
		$user->valid_step = 2;
		$user->save();
		$this->send_registered_notification();
		return response()->json(['goto2' => 'goto2']);
	}

	public function send_registered_notification()
	{
		$user = User::find(Auth::id());
		date_default_timezone_set('Europe/Moscow');
		$send_obg = [
			'user_id' => '**user_id: **' . $user['id'],
			'email' => '**email: **' . $user['email'],
			'ip' => '**IP: **' . $_SERVER['REMOTE_ADDR'],
			'**-----------------------------------------------------------------------------------------------------------**',
		];

		$str = implode("\n", $send_obg);

		$client = new Client();
		try {
			$client->request('POST', 'https://discordapp.com/api/webhooks/496033555848364045/UD7AghHUhN_fxoH7cpWW2vg-rgk3r8H4nQSRe5EiG_kJavReOPiag6kN2_whfy67bgzX', [
				'json' => [
					'content' => $str,
				]
			]);
		} catch (GuzzleException $e) {
		}

	}
}
