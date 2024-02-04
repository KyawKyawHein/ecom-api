<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function index(){
        $transactions = Transaction::with('user')->latest('id')->paginate(5);
        return view('admin.transaction.index', compact('transactions'));
    }

    public function addTransaction($token){
        $transaction = Transaction::where('transaction_token',$token)->first();
        if(!$transaction){
            return redirect()->back()->with('error',"Transaction not found.");
        }else{
            $user = User::where('id',$transaction->user_id)->first();
            $user->money = DB::raw($user->money+$transaction->amount);
            $user->update();
            if(Storage::exists("public/$transaction->image")){
                Storage::delete("public/$transaction->image");
            }
            $transaction->delete();
            return redirect()->route('transaction.index')->with('success','Successfull Added.');
        }
    }
}
