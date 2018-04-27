<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

    public function confirmation()
    {


		return view('admin.confirmation');
    }
}
