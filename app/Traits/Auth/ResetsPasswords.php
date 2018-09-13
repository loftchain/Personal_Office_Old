<?php

namespace App\Traits\Auth;

use App\Models\User;
use App\Models\UserHistoryFields;
use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

trait ResetsPasswords
{
	use RedirectsUsers;

	public function showResetForm(Request $request,$token = null)
	{

		if(Session::get('user_token') !== $request->segment(3)) {
			return view('auth.passwords.token_expired');
		}

		return view('auth.passwords.reset')->with(['token' => $token]);
	}

	protected function validator(array $data)
	{
		return Validator::make($data, [
			'token' => 'required',
			'email' => 'required|string|email|min:7|max:255',
			'password' => 'required|confirmed|string|min:3|max:1024',
			'g-recaptcha-response' => 'required'
		]);
	}

	protected function forgot_history_make($id, $old_pwd, $new_pwd){
		$fg = [
			'forgot_pwd_old' => $old_pwd,
			'forgot_pwd_new' => $new_pwd,
			'forgot_pwd_at' => Carbon::now(),
		];
		if($old_pwd && $new_pwd){
			UserHistoryFields::where('user_id', $id)->update($fg);
		}
	}

	public function reset(Request $request)
	{
		$user = User::where('email', $request['email'])->first();

		$input = $request->all();
		$validator = $this->validator($input);

		if ($validator->fails()) {
			return response()->json(['validation_error' => $validator->errors()]);
		}

		if ($request['email'] != $request->session()->get('reset_password_email')) {
			return response()->json(['reset_email_not_match' => __('auth/resetPwd.emailDontMatch_ResetPasswordsTrait')]);
		}

		if ($request['password'] != $request['password_confirmation']) {
			return response()->json(['not_equal' => __('auth/resetPwd.pwdNotEqual_ResetPasswordsTrait')]);
		}

		$old_password = $user->password;
		$user->password = Hash::make($request['password']);
		$user->token = Str::random(60);
		$user->reset_attempts += 1;
		$user->save();

		$request->session()->forget('user_token');
		$this->forgot_history_make($user['id'], $old_password, $user->password);
		event(new PasswordReset($user));
		$this->guard()->login($user);
		return response()->json(['success_reset_pwd'  => 'success']);
	}

	protected function guard()
	{
		return Auth::guard();
	}
}
