<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends Controller
{
	use RedirectsUsers, ThrottlesLogins;

	protected $redirectTo = '/agreement1';

	public function __construct()
	{
		$this->middleware('guest')->except('logout');
	}

	protected function validator(array $data)
	{
		return Validator::make($data, [
			'email' => 'required|string|email|min:7|max:255',
			'password' => 'required|string|min:3|max:255',
			'g-recaptcha-response' => 'required'
		]);
	}

	public function login(Request $request)
	{
		$input = $request->all();
		$validator = $this->validator($input);
		$user = User::where('email', $request['email'])->first();
		$passwordIsVerified = password_verify($request['password'], $user['password']);

		if ($validator->fails()) {
			return response()->json(['validation_error' => $validator->errors()]);
		}

		if (!$user) {
			return response()->json(['failed' => __('modals/modals.userNotFound_LoginController')]);
		}

		if ($user->reset_attempts > 4) {
			return response()->json(['failed' => __('modals/modals.tooManyResets_LoginController')]);
		}

		if (!$passwordIsVerified) {
			return response()->json(['pwd_not_match' => __('modals/modals.PwdNotMatch_ChangePasswordController')]);
		}

		$this->guard()->login($user);
		return response()->json(['success_login' => 'auth_success']);
	}

	public function logout(Request $request)
	{
		$this->guard()->logout();

		$request->session()->invalidate();

		return redirect('/');
	}

	public function showLoginForm()
	{
		return redirect('agreement1');
	}

	protected function guard()
	{
		return Auth::guard();
	}
}
