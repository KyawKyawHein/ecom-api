<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            "email" => ['required', 'email'],
            "password" => ['required', 'confirmed']
        ]);
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);
        return response()->json([
            'user' => $user,
            'token' => $user->createToken("api token of $user->name")->plainTextToken
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            "email" => ['required', 'email'],
            "password" => ['required'],
        ]);
        if (Auth::attempt($request->only(['email', 'password']))) {
            $user = Auth::user();
            $token = $user->createToken("api token of $user->name")->plainTextToken;
            return response()->json([
                "user" => $user,
                "token" => $token
            ]);
        } else {
            return response()->json(['error' => "Invalid credentials"], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => "Successfully logged out."
        ]);
    }

    public function passwordChange(Request $request){
        $request->validate([
            "oldPassword" => ['required'],
            "password"=>['required','confirmed']
        ]);
        if(Hash::check($request->oldPassword,$request->user()->password)){
            $request->user()->update([
                "password" => Hash::make($request->password)
            ]);
            return response()->json([
                "message" => "Password is changed."
            ]);
        }else{
            return response()->json([
                "error"=>"Password is incorrect."
            ],422);
        }
    }
}
