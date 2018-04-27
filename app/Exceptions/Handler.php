<?php

namespace App\Exceptions;

use Exception;
use GuzzleHttp\Client;
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

//		$user = User::find(Auth::id());
//		$user_fields = UserPersonalFields::where('user_id', $user['id'])->first();
//		$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//
//		$send_obg = [
//			'error_message' => '[ ' . $exception->getMessage() . ' ]',
//			'code' => '<b>Code: </b>' . app('Illuminate\Http\Response')->status(),
//			'path' => '<b>Path: </b>' . $exception->getFile(),
//			'line' => '<b>Line: </b>' . $exception->getLine(),
//			'url' => '<b>URL: </b>' . $url,
//			'user_id' => '<b>user_id: </b>' . $user['id'],
//			'email' => '<b>email: </b>' . $user['email'],
//			'name' => '<b>name: </b>' . $user_fields['name_surname'],
//			'phone' => '<b>phone: </b>' . $user_fields['phone'],
//			'telegram_login' => '<b>telegram_login: </b>' . $user_fields['telegram'],
//			'country' => '<b>country: </b>' . $user_fields['country'],
//			'ip' => '<b>ip: </b>' . $_SERVER['REMOTE_ADDR'],
//			'user_agent' => '<b>user_agent: </b>' . $request->header('User-Agent'),
//		];
//
//		$str = implode("\n", $send_obg);
//		$client = new Client();
//		if (
//			$send_obg['error_message'] != '[ The given data was invalid. ]' &&
//			strpos($send_obg['url'], 'apple') == false &&
//			strpos($send_obg['url'], 'glyphicon') == false &&
//			strpos($send_obg['url'], 'assetlinks.json') == false &&
//			strpos($send_obg['url'], 'misc.js') == false
//		) { // If someone didn`t pass the validation process of any form.
//			$client->request('POST', 'https://api.telegram.org/bot542831533:AAFtNtYGVbKZT_19Ir_YrxOuaRYjbSRRHFI/sendmessage', [
//				'json' => [
//					'chat_id' => env('EMERGENCY_CHAT_ID'),
//					'text' => $str,
//					'parse_mode' => 'HTML',
//				]
//			]);
//		}

		return parent::render($request, $exception);
	}
}
