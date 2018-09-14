<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserHistoryFields;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
	public function showRegistrationForm()
	{
		return redirect('login');
	}

	public function __construct()
	{
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

	protected function reg_history_make($user){
		UserHistoryFields::create([
			'user_id' => $user->id,
			'reg_email' => $user->email,
			'reg_pwd' => $user->password,
			'reg_at' => Carbon::now()
		]);
	}

	protected function create(array $data)
	{
		$referred_by = User::where('token', Cookie::get('referral'))->first();

		$user = User::create([
			'email' => $data['email'],
			'password' => $data['password'],
			'referred_by'   => $referred_by->id ?? null
		]);
		return $user;
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
		$user->token = str_random(15);
		$user->ip_token = request()->ip()   ;
		$user->password = bcrypt($data['password']);
		$user->remember_token = str_random(60);
		$user->reg_attempts += 1;
		$user->valid_step = 1;
		$user->save();

		try{
			$this->guard()->login($user);
			$this->reg_history_make($user);
		}
		catch(\Exception $e){
			Log::info('Something went wrong while register this user.');
		}

		return response()->json(['success_register' => 'good']);
	}

	protected function guard()
	{
		return Auth::guard();
	}

}
