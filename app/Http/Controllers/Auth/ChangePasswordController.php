<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\UserHistoryFields;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{

	public function __construct()
	{
		$this->middleware('valid');
	}

	protected function validator(array $data)
	{
		return Validator::make($data, [
			'email' => 'required|string|email|min:7|max:255',
			'password1' => 'required|string|min:3|max:1024',
			'password2' => 'required|string|min:3|max:1024',
			'g-recaptcha-response' => 'required'

		]);
	}

	protected function change_pwd_history_make($old_pwd, $new_pwd){
		$chp = [
			'change_pwd_old' => bcrypt($old_pwd),
			'change_pwd_new' => bcrypt($new_pwd),
			'change_pwd_at' => Carbon::now(),
		];
		if($old_pwd && $new_pwd){
			UserHistoryFields::where('user_id', Auth::id())->update($chp);
		}
	}

	public function renew_password(Request $request)
	{
		$input = $request->all();
		$validator = $this->validator($input);
		$user = $request->user();
		$passwordIsVerified = password_verify($request['password1'], $user->password);

		if (strlen($user->password) < 15) {
			return redirect(route('logout'));
		}

		if ($validator->fails()) {
			return response()->json(['validation_error' => $validator->errors()]);

		}

		if (!$passwordIsVerified) {
			return response()->json(['pwd_not_match' => Lang::get('controller/changeEmail.pwd_not_match')]);
		}

		if ($input['email'] != $user->email && strlen($user->email) > 6) {
			return response()->json(['not_your_email' => Lang::get('controller/changeEmail.not_yours')]);
		}

		if (trim(strtolower($input['password1'])) == trim(strtolower($input['password2']))) {
			return response()->json(['not_equal' => Lang::get('controller/changePassword.not_equal')]);
		}

		$request->user()->fill([
			'password' => bcrypt($request['password2'])
		])->save();

		$this->change_pwd_history_make($input['password1'], $input['password2']);
		return response()->json(['success_changed_pwd' => Lang::get('controller/changePassword.success')]);
	}
}

