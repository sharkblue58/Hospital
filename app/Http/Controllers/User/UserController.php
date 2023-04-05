<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        try {

            $allUsers =User::all();
           
            if ($allUsers!= null) {
                $allUsers = UserResource::collection(User::all() );
            } else {
                return response()->json([
                    'status' => 'true',
                    'msg' => 'there is no users now '
                ],201);
            }
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'expcetion' => $ex->getMessage(), 'msg' => 'failed to get users'], 500);
        }

    }
    


    public function store( UserRequest $request)
    {
        $request->validated($request->all());

        $user= User::create([
          
            'first_name' => $request->first_name, 
            'last_name' => $request->last_name, 
            'gender' => $request->gender, 
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password' =>Hash::make($request->password),
        ]);

        return new UserResource($user);
    }

    
    public function show( Request $user,$id)
    {

        try{
            $user=User::find($id);
            if($user!=null){
                return   new UserResource($user);
            }else{
                return response()->json([
                    'status' => 'true',
                    'msg' => 'no records with this id ,please check id ! '
                ],201);
            }  
        }catch (Exception $ex) {
            return response()->json(['status' => 'error', 'expcetion' => $ex->getMessage(), 'msg' => 'view process failed'], 500);
        }


    }

   

   
    public function update($id,UserUpdateRequest  $request)
    {

        $user =User ::find($id);
        $user ->update($request->all());
        return new UserResource($user );
    }

    public function destroy($id)
    {
       
        try{
            $user= User::find($id );
            if($user!=null){
                $user->delete();
                return response()->json([
                    'status' => 'true',
                    'msg' => ' records have been deleted  ! '
                ],201);
            }else{
                return response()->json([
                    'status' => 'true',
                    'msg' => 'no records with this id ,please check id ! '
                ],201);
            }  
        }catch (Exception $ex) {
            return response()->json(['status' => 'error', 'expcetion' => $ex->getMessage(), 'msg' => 'delete process failed'], 500);
        }
    }

}
