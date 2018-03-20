<?php

namespace App\Traits\Auth;

use App\Models\User;
use App\Models\UserHistoryFields;
use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
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

	/**
	 * Display the password reset view for the given token.
	 *
	 * If no token is present, display the link request form.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  string|null $token
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showResetForm(Request $request, $token = null)
	{
		return view('auth.passwords.reset')->with(
			['token' => $token, 'email' => $request->email]
		);
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

	protected function forgot_history_make($old_pwd, $new_pwd){
		$fg = [
			'forgot_pwd_old' => $old_pwd,
			'forgot_pwd_new' => $new_pwd,
			'forgot_pwd_at' => Carbon::now(),
		];
		if($old_pwd && $new_pwd){
			Log::info($old_pwd);
			Log::info($new_pwd);
			Log::info(Auth::id());
			UserHistoryFields::where('user_id', Auth::id())->update($fg);
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
			return response()->json(['reset_email_not_match' => 'reset email does not match']);
		}

		if ($request['password'] != $request['password_confirmation']) {
			return response()->json(['not_equal' => 'passwords are not equal']);
		}
		$old_password = $user->password;
		$user->password = Hash::make($request['password']);
		$user->setRememberToken(Str::random(60));
		$user->save();

		$this->forgot_history_make($old_password, $user->password);
		event(new PasswordReset($user));
		$this->guard()->login($user);
		return response()->json(['success_reset_pwd'  => 'success']);
	}

	protected function guard()
	{
		return Auth::guard();
	}
}
