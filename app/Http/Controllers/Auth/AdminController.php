<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\user\LoginRequest;
use App\Notifications\LoginNotification;


class AdminController extends Controller
{
    public function adminLogin(LoginRequest $request){
        $cridentials=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        if(Auth::guard('admin')->attempt($cridentials)){
            $user=Auth::guard('admin')->user();
            $user->tokens()->delete();
            $user->notify(new LoginNotification());
            $success['token']=$user->createToken('admin',['admin'])->plainTextToken;
            $success['name']=$user->first_name;
            $success['success']=true;
            return response()->json($success,200);
        }else{
            return response()->json(['error'=>'Cridentials not Right'],401);
        }
    }
}
