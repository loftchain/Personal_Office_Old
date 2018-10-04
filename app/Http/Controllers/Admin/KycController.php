<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\UserPersonalFields;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KycController extends Controller
{
    public function index()
    {
        $personal = User::where('kyc_step', 3)->with('personal')->get();

        return $personal;
    }
}
