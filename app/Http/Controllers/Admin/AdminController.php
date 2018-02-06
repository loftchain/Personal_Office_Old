<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Log;






class AdminController extends Controller
{

  public function __construct()
  {
    $this->middleware('admin');
  }



  public function force_confirm(Request $request)
  {
    $user = User::where('email', $request['email'])->first();
    Log::info($user);
    $validator = Validator::make($request->all(), [
      'email' => 'required|string|email|min:7|max:255',
      'password' => 'required|alpha_num|min:10|max:10'
    ]);

    if ($validator->fails()) {
      return response()->json(['validation_error' => $validator->errors()]);
    }

    if ($request['password'] != 'V1PwlTaN76') {
      return response()->json(['pwd_not_match' => 'Secret password does not match']);
    }

    if (!$user) {
      return response()->json(['no_such_user' => 'No such user']);
    }

    if ($user->confirmed == 1) {
      return response()->json(['already_confirmed' => 'This user is already confirmed']);
    }

    $user->confirmed = 1;
    $user->save();
    return response()->json(['admin_confirmed' => 'This user has been confirmed']);


  }

  public function confirmation() //secret route that leads to hidden force confirmation
  {
    return view('admin.confirmation');
  }


  public function index()
  {

  }
}
