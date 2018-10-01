<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BonusController extends Controller
{
    public function index()
    {
        $users = DB::table('whitelist')
            ->join('users', 'whitelist.email', 'users.email')
            ->join('transactions', 'users.id', 'transactions.user_id')
            ->leftjoin('user_wallet_fields', 'transactions.from', 'user_wallet_fields.wallet')
            ->select('users.id', 'users.email', 'user_wallet_fields.wallet', 'transactions.amount_tokens')
            ->get();

        return [
            'status' => 'ok',
            'users' => $users,
        ];
    }
}
