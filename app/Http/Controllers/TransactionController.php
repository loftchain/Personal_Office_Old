<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\TransactionService;
use App\Services\WalletService;
use App\Services\WidgetService;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use App\Models\UserHistoryFields;
use App\Models\UserWalletFields;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use ReCaptcha\ReCaptcha;

class TransactionController extends Controller
{
	protected $walletService;
	protected $txService;

	public function __construct(WalletService $walletService, TransactionService $txService)
	{
		$this->walletService = $walletService;
		$this->txService = $txService;
		$this->middleware('valid');
	}

	public function storeTxToDb(){
		$this->txService->storeTx();
	}

	public function getDataForMyTx(){
		$user = User::find(Auth::id());
		$txData = ($user->confirmed == '1') ? $this->txService->getDataForMyTx() : '';
		return $txData;
	}

}
