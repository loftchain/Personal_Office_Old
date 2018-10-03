<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transactions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    //Update the status of the transaction if it was successfully sent
    public function updateSend(Request $request)
    {
        $transaction = Transactions::where('transaction_id', $request->id)->first();
        if ($request->action == 'token_send')
            $transaction->send = 'true';
        if ($request->action == 'bonus_send')
            $transaction->bonus_send = 'true';
        if ($request->action == 'refs_send')
            $transaction->refs_send = 'true';
        $transaction->save();

        return [
            'status' => 'ok'
        ];
    }
}
