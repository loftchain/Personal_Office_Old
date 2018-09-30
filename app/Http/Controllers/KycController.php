<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KycController extends Controller
{
    public function index()
    {
        return view('kyc.index');
    }

    public function userUpdate(Request $request)
    {
        Auth::user()->update([
            'kyc_step' => 3,
            'kyc_token' => $request->token
        ]);

        return ['status' => 'ok'];
    }
}
