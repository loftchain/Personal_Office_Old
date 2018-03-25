<?php

namespace App\Services;

use App\Helpers\ICOAPI;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\HomeController;
use GuzzleHttp\Client;



class WidgetService
{

	public function getTx()
	{
		$client = new Client();
		$res = $client->request('GET', env('SELF_API_URL') . '/api/tx/' . env('CUSTOMER_ID'));
		$body = json_decode($res->getBody());
		return $body;
	}

}