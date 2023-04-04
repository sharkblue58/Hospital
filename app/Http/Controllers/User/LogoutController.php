<?php

namespace App\Http\Controllers\User;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(){
     
     try {
        Auth::user()->currentAccessToken()->delete();
       
            return response()->json([
                'status' => 'true',
                'user' => 'you are logged out now',
            ], 201);

    } catch (Exception $ex) {
        return response()->json(['status' => 'error', 'expcetion' => $ex->getMessage(), 'msg' => 'view process failed'], 500);
    }
    }
}
