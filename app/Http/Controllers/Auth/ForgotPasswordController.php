<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UnisenderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
		protected $unisenderService;
    public function __construct(UnisenderService $unisenderService)
    {
        $this->middleware('guest');
	      $this->unisenderService = $unisenderService;
    }

	protected function validator(array $data)
	{
		return Validator::make($data, [
			'email' => 'required|string|email|min:7|max:255',
			'g-recaptcha-response' => 'required'
		]);
	}

	public function sendResetLinkEmailCustom(Request $request)
	{
		$input = $request->all();
		$user = User::where('email', $request['email'])->first();
		$validator = $this->validator($input);

		if ($validator->fails()) {
			return response()->json(['validation_error'=>$validator->errors()]);
		}

		if (!$user){
			return response()->json(['failed'=> __('auth.not_found')]);
		}

		$emailResponse = $this->unisenderService->sendEmail(
			$request['email'],
			__('mails/mails.resetPasswordSubject_controller'),
			view("mails.reset_password_confirmation", ["user"=>$user])->render()
		);
		$request->session()->put('reset_password_email', $request['email']);
		$request->session()->put('user_token', $user->token);

		if($emailResponse->result){
			return response()->json(['success_reset_email_sent' => $emailResponse]);
		} else {
			Log::info(json_encode($emailResponse));
			return response()->json(['error_reset_email_sent' => json_encode($emailResponse)]);
		}

	}




}
