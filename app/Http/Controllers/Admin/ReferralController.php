<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserReferralFields;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReferralController extends Controller
{
    public function index()
    {
        return UserReferralFields::all();
    }

    public function update(Request $request)
    {
        $referral = UserReferralFields::where('id', $request->id)->first();
        $referral->send = 'true';
        $referral->save();

        return [
            'status' => 'ok'
        ];
    }
}
