<?php

namespace App\Http\Controllers\Auth\StepValidation;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPersonalFields;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

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
      'user_id'=> Auth::id(),
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
    $this->create($input)->toArray();
    $user = User::find(Auth::id());
    $user->valid_step = 3;
    $user->valid_at = Carbon::now();
    $user->save();
    return response()->json(['goto3' => 'goto3']);

  }

}
