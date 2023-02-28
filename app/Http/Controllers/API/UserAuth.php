<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuth extends Controller
{
    public function Login(AuthRequest $request){
        if (Auth::attempt(['email'=>$request->email , 'password'=>$request->password])){
            $token = $request->user()->createtoken($request->user()->email); 
            return response()->json(['message'=>'login succsessfuly' , 'status'=>200 , 'token'=>$token->plainTextToken ]);
        }; 
        return response()->json(['message'=>'authentication fail' , 'status'=>200]);
    }
    public function Logout(){
    }
}
