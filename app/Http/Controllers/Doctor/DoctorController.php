<?php

namespace App\Http\Controllers\Doctor;

use Exception;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Http\Resources\DoctorResource;

class DoctorController extends Controller
{
        
    public function index()
    {
        try {

            $allDoctors = DoctorResource::collection(
                Doctor::all()
          );
           
            if ($allDoctors!= null) {
                return response()->json([
                    'status' => 'true',
                    'data' => $allDoctors,
                ], 201);
            } else {
                return response()->json([
                    'status' => 'true',
                    'msg' => 'there is no doctors now '
                ],201);
            }
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'expcetion' => $ex->getMessage(), 'msg' => 'failed to get doctors'], 500);
        }

    }
    


    public function store( DoctorRequest $request)
    {
        $request->validated($request->all());

        $doctor= Doctor::create([
          
            'first_name' => $request->first_name, 
            'last_name' => $request->last_name, 
            'gender' => $request->gender,     
        ]);

        return new DoctorResource($doctor);
    }

    
    public function show( Request $doctor,$id)
    {

        try{
            $doctor=Doctor::find($id);
            if($doctor!=null){
                return   new DoctorResource($doctor);
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

   

   
    public function update($id,DoctorRequest  $request)
    {

        $doctor =Doctor ::find($id);
        $doctor ->update($request->all());
        return new DoctorResource($doctor );
    }

    public function destroy($id)
    {
       
        try{
            $doctor= Doctor::find($id );
            if($doctor!=null){
                $doctor->delete();
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
