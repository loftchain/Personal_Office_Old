<?php

namespace App\Traits\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


trait SendsPasswordResetEmails
{

	protected function validator(array $data)
	{
		return Validator::make($data, [
			'email' => 'required|string|email|min:7|max:255',
			'g-recaptcha-response' => 'required'
		]);
	}

	public function sendResetLinkEmail(Request $request)
	{
		$input = $request->all();
		$user = User::where('email', $request['email'])->first();
		$validator = $this->validator($input);

		if ($validator->fails()) {
			return response()->json(['validation_error'=>$validator->errors()]);
		}

		if (!$user){
			return response()->json(['failed'=>trans('auth.not_found')]);
		}

		$response = $this->broker()->sendResetLink($request->only('email'));

		$request->session()->put('reset_password_email', $request['email']);
		return $response == Password::RESET_LINK_SENT
			? $this->sendResetLinkResponse($response)
			: $this->sendResetLinkFailedResponse($request, $response);
	}


	protected function validateEmail(Request $request)
	{
		$this->validate($request, ['email' => 'required|email|min:7|max:255']);
	}

	protected function sendResetLinkResponse($response)
	{
		return response()->json(['success_reset_email_sent' => $response]);
	}

	protected function sendResetLinkFailedResponse(Request $request, $response)
	{
		return back()->withErrors(
			['email' => trans($response)]
		);
	}

	public function broker()
	{
		return Password::broker();
	}
}
