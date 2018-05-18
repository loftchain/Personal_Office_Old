<?php

namespace App\Exceptions;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\UserPersonalFields;
use Illuminate\Http\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
	/**
	 * A list of the exception types that are not reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		//
	];

	/**
	 * A list of the inputs that are never flashed for validation exceptions.
	 *
	 * @var array
	 */
	protected $dontFlash = [
		'password',
		'password_confirmation',
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception $exception
	 * @return void
	 */
	public function report(Exception $exception)
	{
		parent::report($exception);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Exception $exception
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $exception)
	{

		$user = User::find(Auth::id());
		$user_fields = UserPersonalFields::where('user_id', $user['id'])->first();
		$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		date_default_timezone_set('Europe/Moscow');

		$send_obg = [
			'error_message' => '[ ' . $exception->getMessage() . ' ]',
			'code' => '**Code: **' . app('Illuminate\Http\Response')->status(),
			'path' => '**Path: **' . $exception->getFile(),
			'line' => '**Line: **' . $exception->getLine(),
			'url' => '**URL: **' . $url,
			'user_id' => '**user_id: **' . $user['id'],
			'email' => '**email: **' . $user['email'],
			'name' => '**name: **' . $user_fields['name_surname'],
			'phone' => '**phone: **' . $user_fields['phone'],
			'telegram_login' => '**telegram_login: **' . $user_fields['telegram'],
			'country' => '**country: **' . $user_fields['country'],
			'ip' => '**ip: **' . $_SERVER['REMOTE_ADDR'],
			'user_agent' => '**user_agent: **' . $request->header('User-Agent'),
			'**-----------------------------------------------------------------------------------------------------------**',
		];
		if (env('APP_ENV' != 'local')) {
			$str = implode("\n", $send_obg);
			$client = new Client();
			if (
				$send_obg['error_message'] != '[ The given data was invalid. ]' &&
				strpos($send_obg['url'], 'apple') == false &&
				strpos($send_obg['url'], 'glyphicon') == false &&
				strpos($send_obg['url'], 'assetlinks.json') == false &&
				strpos($send_obg['url'], 'misc.js') == false
			) { // If someone didn`t pass the validation process of any form.
				try {
					$client->request('POST', 'https://discordapp.com/api/webhooks/446240970183540737/fJ6GKNAjzqVkKGefZ16KbyKtNsD2qRrQ8e7M0drBEKuRfPhCDs1XEDf4gGLMw60kN188', [
						'json' => [
							'content' => $str,
						]
					]);
				} catch (GuzzleException $e) {
				}

			}
		}

		return parent::render($request, $exception);
	}
}
