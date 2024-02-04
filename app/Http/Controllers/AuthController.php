<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        return view('admin.auth.login');
    }
    public function postLogin(Request $request)
    {
        $formData=$request->validate([
            'email'=>['required','email','exists:users,email'],
            "password"=>['required']
        ]);

        if(Auth::attempt($formData)){
            if(Auth::user()->isAdmin=='true'){
                return redirect()->route('admin-dashboard')->with('success','Welcome to Admin Dashboard.');
            }else{
                return redirect()->route('login')->with('error',"Only admin has permission to enter.");
            }
        }else{
            return redirect()->back()->withErrors([
                "email"=>"Email or password is incorrect.",
                "password"=>'Email or password is incorrect.'
            ]);            
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
