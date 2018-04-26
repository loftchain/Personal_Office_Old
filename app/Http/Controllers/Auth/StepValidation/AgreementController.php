<?php

namespace App\Http\Controllers\Auth\StepValidation;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPersonalFields;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AgreementController extends Controller
{

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	protected function create(array $data)
	{
		return UserPersonalFields::create([
			'user_id' => Auth::id(),
			'name_surname' => $data['name_surname'],
			'telegram' => $data['telegram'],
			'emergency_email' => $data['emergency_email'],
			'permanent_address' => $data['permanent_address'],
			'contact_number' => $data['contact_number'],
			'date_place_birth' => $data['date_place_birth'],
			'nationality' => $data['nationality'],
			'source_of_funds' => $data['source_of_funds'],
		]);
	}

	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name_surname' => 'required|string|max:255',
			'emergency_email' => 'required|string|email|min:7|max:255',
			'permanent_address' => 'required|string|max:255',
			'contact_number' => 'required|numeric',
			'date_place_birth' => 'required|string|max:255',
			'nationality' => 'required|string|max:255',
			'source_of_funds' => 'required|string|max:255',
//			'input_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
//			'input_img1' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
		]);
	}

	public function goToAgreement2()
	{
		$user = User::find(Auth::id());
		$user->valid_step = 2;
		$user->save();
		return response()->json(['goto2' => 'goto2']);
	}

	public function store_personal_data(Request $request)
	{
		$input = $request->all();
		$validator = $this->validator($input);

		if ($validator->fails()) {
			return response()->json(['validation_error' => $validator->errors()]);
		}

		$this->create($input)->toArray();
		$user = User::find(Auth::id());
		$user->valid_step = 3;
		$user->valid_at = Carbon::now();
		$user->save();
		return response()->json(['goto3' => 'goto3']);

	}

	public function store_documents()
	{
		$user = User::find(Auth::id());

		$allowed = array('png', 'jpg', 'jpeg', 'svg', 'gif', 'pdf', 'zip', 'rar');
		if (isset($_FILES['upl']) && $_FILES['upl']['error'] == 0) {

			$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

			if (!in_array(strtolower($extension), $allowed)) {
				echo '{"status":"error"}';
				exit;
			}

			$fileName = time() . '-' . $user->email . '-' . $_FILES['upl']['name'];

			if (move_uploaded_file($_FILES['upl']['tmp_name'], env('UPLOAD_PATH') . $fileName)) {
				echo '{"status":"success"}';
				exit;
			}
			
			$userPersonalField = UserPersonalFields::updateOrCreate(['user_id' => $user->id], ['doc_img_path' => env('APP_URL') . '/uploads/' . $fileName]);
			$userPersonalField->save();
		}

		echo '{"status":"error"}';
		return;
	}
}
