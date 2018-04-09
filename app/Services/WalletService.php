<?php

namespace App\Services;

use App\Helpers\ICOAPI;
use App\Models\UserWalletFields;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\HomeController;
use GuzzleHttp\Client;
use App\Services\BonusService;


class WalletService
{


	public function getCurrentWallets()
	{
		return UserWalletFields::where('user_id', Auth::id())->get();
	}

}