<?php

namespace App\Traits\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

trait SendsPasswordResetEmails
{

	public function sendResetLinkEmail(Request $request)
	{
		$this->validateEmail($request);

		$response = $this->broker()->sendResetLink(
			$request->only('email')
		);

		$request->session()->put('reset_password_email', $request['email']);
		return $response == Password::RESET_LINK_SENT
			? $this->sendResetLinkResponse($response)
			: $this->sendResetLinkFailedResponse($request, $response);
	}


	protected function validateEmail(Request $request)
	{
		$this->validate($request, ['email' => 'required|email']);
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
