<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\user\LoginRequest;
use App\Notifications\LoginNotification;


class LoginController extends Controller
{

    public function login(LoginRequest $request){
        $cridentials=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        if(auth()->attempt($cridentials)){
            $user=Auth::user();
            $user->tokens()->delete();
            $user->notify(new LoginNotification());
            $success['token']=$user->createToken('user',['user'])->plainTextToken;
            $success['name']=$user->first_name;
            $success['role']=$user->role;
            $success['success']=true;
            return response()->json($success,200);
        }elseif(Auth::guard('admin')->attempt($cridentials)){
            $user=Auth::guard('admin')->user();
            $user->tokens()->delete();
            $user->notify(new LoginNotification());
            $success['token']=$user->createToken('admin',['admin'])->plainTextToken;
            $success['name']=$user->first_name;
            $success['role']=$user->role;
            $success['success']=true;
            return response()->json($success,200);
        }
        else{
            return response()->json(['error'=>'Cridentials not Right'],401);
        }
    }

}
