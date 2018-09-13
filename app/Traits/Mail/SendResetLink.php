<?php

namespace App\Traits\Mail;

use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;


trait SendResetLink
{

	public function sendResetEmail($email){

		$user = User::where('email', $email)->first();

		$client = new Client();
		$url = 'https://api.unisender.com/ru/api/sendEmail';
		$params  = [
			'format' => 'json',
			'api_key' => env('UNISENDER_API_KEY'),
			'email' => $email,
			'sender_name' => env('UNISENDER_FROM_NAME'),
			'sender_email' => env('UNISENDER_FROM_EMAIL'),
			'subject' => 'Password reset',
			'body' => view("mails.reset_password_confirmation", ["user"=>$user])->render(),
			'list_id' => env('UNISENDER_LIST_ID'),
		];

		try{
			$response = $client->request('POST', $url, [
				'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
				'form_params' => $params,
				'verify'=>false,
			]);
			$body = $response->getBody();
			Log::info($body);
		} catch (GuzzleException $e) {

		}

	}

}