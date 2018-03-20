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


class ChangeEmailController extends Controller
{
	public function __construct()
	{
		$this->middleware('valid');
	}

	protected function validator(array $data)
	{
		return Validator::make($data, [
			'email1' => 'required|string|email|min:7|max:255',
			'email2' => 'required|string|email|min:7|max:255',
			'password' => 'required|string|min:3|max:1024',
			'g-recaptcha-response' => 'required',
		]);
	}

	protected function change_email_history_make($old_email, $new_email){
		$chm = [
			'change_email_old' => $old_email,
			'change_email_new' => $new_email,
			'change_email_at' => Carbon::now(),
		];

		if($old_email && $new_email){
			UserHistoryFields::where('user_id', Auth::id())->update($chm);
		}
	}

	public function reset_email(Request $request)
	{
		$input = $request->all();
		$validator = $this->validator($input);
		$user = $request->user();
		$possible_user = User::where('email', $input['email2'])->first();
		$passwordIsVerified = password_verify($request['password'], $user->password);

		if ($validator->fails()) {
			return response()->json(['validation_error' => $validator->errors()]);
		}

		if ($user->email != $input['email1']) {
			return response()->json(['not_your_email' => Lang::get('controller/changeEmail.not_yours')]);
		}

		if (trim(strtolower($input['email1'])) == trim(strtolower($input['email2']))) {
			return response()->json(['not_equal' => Lang::get('controller/changeEmail.not_equal')]);

		}
		if (!$passwordIsVerified) {
			return response()->json(['pwd_not_match' => Lang::get('controller/changeEmail.pwd_not_match')]);
		}
		if (!$user || $possible_user) {
			return response()->json(['is_taken' => Lang::get('controller/changeEmail.is_taken')]);
		}

		$user->email = $input['email2'];
		$user->save();

		$this->change_email_history_make($input['email1'], $input['email2']);
		return response()->json(['success_changed_email' => Lang::get('controller/changeEmail.success')]);

	}
}
