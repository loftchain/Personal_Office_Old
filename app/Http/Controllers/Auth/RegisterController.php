<?php

namespace App\Http\Controllers\Auth;

use App\Mail\ConfirmRegistration;
use App\Traits\ChangeUserFieldTrait;
use App\Traits\SendDataServerTrait;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\UserHistoryFields;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Traits\Auth\RegistersUsers;
use phpDocumentor\Reflection\Types\Null_;
use ReCaptcha\ReCaptcha;
use App\Traits\CaptchaTrait;
use App\Traits\RegisterMailTrait;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client;
use App\Traits\RemoteHistoryTrait;
use App\Models\Conversion;
use Postmark\PostmarkClient;


class RegisterController extends Controller
{
	use CaptchaTrait, RegisterMailTrait, ChangeUserFieldTrait, SendDataServerTrait;

	use RegistersUsers, RemoteHistoryTrait;

	public function __construct()
	{
		$token = Input::get('code');
		$this->middleware('guest');
	}

	protected function validator(array $data)
	{
		return Validator::make($data, [
			'email' => 'required|string|email|min:7|max:255|unique:users',
			'password' => 'required|string|min:3|max:255',
			'g-recaptcha-response' => 'required'
		]);
	}

	protected function create(array $data)
	{

		$user = User::create([
			'email' => $data['email'],
			'password' => $data['password']
		]);
		return $user;
	}

	public function resend($email)
	{

	}

	public function confirmation(Request $request, $token)
	{
		$user = User::where('token', $token)->first();
		Log::info($user);
		if ($user) {
			$user->confirmed = 1;
			$user->save();
		}
		$request->session()->put('Confirmed', 'Your account has been successfully confirmed');
		return redirect(route('root') . '?token=' . $token);
	}

	protected function register(Request $request)
	{
		$input = $request->all();
		$validator = $this->validator($input);

		if ($validator->fails()) {
			return response()->json(['validation_error' => $validator->errors()]);
		}

		$data = $this->create($input)->toArray();
		$user = User::find($data['id']);

		$data['token'] = str_random(10);
		$data['ip_token'] = $_SERVER['REMOTE_ADDR'];
		$user->token = $data['token'];
		$user->password = bcrypt($data['password']);
		$user->remember_token = str_random(32);
		$user->reg_attempts = 1;
		$user->valid_step = 1;
		$user->confirmed = 1;
		$user->save();
		try{
			$this->guard()->login($user);
		}
		catch(\Exception $e){
			Log::info('Something went wront while login this user.');
		}
		return response()->json(['success_register' => Lang::get('controller/register.pwd_sent'), 'email' => $data['email']]);
	}

	protected function guard()
	{
		return Auth::guard();
	}

}
