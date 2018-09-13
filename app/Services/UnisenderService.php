<?php

namespace App\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class UnisenderService
{

	public function sendEmail($email, $subject, $view)
	{

		$client = new Client();
		$url = 'https://api.unisender.com/ru/api/sendEmail';
		$params  = [
			'format' => 'json',
			'api_key' => env('UNISENDER_API_KEY'),
			'email' => $email,
			'sender_name' => env('UNISENDER_FROM_NAME'),
			'sender_email' => env('UNISENDER_FROM_EMAIL'),
			'subject' => $subject,
			'body' => $view,
			'list_id' => env('UNISENDER_LIST_ID'),
			'lang' => App::getLocale()
		];

		try{
			$response = $client->request('POST', $url, [
				'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
				'form_params' => $params,
				'verify'=>false,
			]);
			$body = json_decode($response->getBody());
		} catch (GuzzleException $e) {
				Log::info($e->getMessage());
		}
		return $body;
	}
}