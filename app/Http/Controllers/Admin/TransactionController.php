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
        $transaction->send = 'true';
        $transaction->save();

        return [
            'status' => 'ok'
        ];
    }
}
