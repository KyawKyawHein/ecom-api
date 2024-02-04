<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function addMoney(Request $request){
        $request->validate([
            "amount"=>['required','integer'],
            "amountFile"=>['required','image','mimes:png,jpg,jpeg']
        ]);

        $file = $request->file('amountFile');
        $pathName=$file->store('images','public');

        $transaction = Transaction::create([
            "user_id" =>Auth::id(),
            "amount" =>$request->amount,
            "transaction_token"=>Str::random(32),
            "image"=>$pathName
        ]);
        return response()->json([
            "success"=>"Transaction is added."
        ]);
    }
}
