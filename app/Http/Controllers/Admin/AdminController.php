<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmRegistration;
use App\Mail\ReturnToStep2;
use App\Models\User;
use App\Models\UserPersonalFields;
use App\Services\MailChimpService;
use App\Services\TransactionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

	protected $txService;
	protected $mailChimpService;

	public function __construct(TransactionService $txService, MailChimpService $mailChimpService)
	{
		$this->txService = $txService;
		$this->mailChimpService = $mailChimpService;
		$this->middleware('auth');
	}

	public function get_user_info(){
		$usersPersonal = UserPersonalFields::where('user_id', '!=', Auth::id())->orderBy('id', 'desc')->get();
		$users = [];
		foreach ($usersPersonal as $up) {
			$_user = User::find($up->user_id);
				$_user['name_surname'] = $up->name_surname;
				$_user['permanent_address'] = $up->permanent_address;
				$_user['contact_number'] = $up->contact_number;
				$_user['date_place_birth'] = $up->date_place_birth;
				$_user['nationality'] = $up->nationality;
				$_user['source_of_funds'] = $up->source_of_funds;
				$_user['promo'] = $up->promo;
				$_user['doc_img_path'] = $up->doc_img_path;
				$users[] = $_user;
		}
		return $users;
	}

    public function confirmation($user_id)
    {
	    $user = User::find($user_id);
	    $user->confirmed = 1;
	    $user->confirmed_at = Carbon::now();
	    $user->save();
	    $this->mailChimpService->sendCampaign($user->email, __('mails/mails.confirmation_subject'), 'mails.registration_confirmation');
	    return response()->json(['confirmation_complete' => 'confirmation_complete']);
    }

	public function return_to_step2($user_id)
	{
		$user = User::find($user_id);
		$user->valid_step = 2;
		$user->save();
		UserPersonalFields::where('user_id', $user_id)->delete();
		$this->mailChimpService->sendCampaign($user->email, __('mails/mails.return_subject'), 'mails.return_to_step2');
		return response()->json(['returned_to_step2' => 'returned_to_step2']);
	}

	public function getFile($fileName)
	{
		return Storage::download('uploads/'. $fileName);
	}

	public function confirm_view($data)
	{
		return view('admin.confirmation')->with('data', $data);
	}

	public function getDataForAdminTx(){
		return $this->txService->getDataForAdminTx();
	}
}
