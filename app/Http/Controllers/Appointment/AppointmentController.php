<?php

namespace App\Http\Controllers\Appointment;

use Exception;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Http\Resources\AppointmentResource;


class AppointmentController extends Controller
{
   
    
    public function index()
    {
        try {

            $allAppointment = AppointmentResource::collection(
                Appointment::all()
          );
           
            if ($allAppointment!= null) {
                return response()->json([
                    'status' => 'true',
                    'data' => $allAppointment,
                ], 201);
            } else {
                return response()->json([
                    'status' => 'true',
                    'msg' => 'there is no reviews now '
                ],201);
            }
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'expcetion' => $ex->getMessage(), 'msg' => 'failed to get reviews'], 500);
        }

    }
    


    public function store( AppointmentRequest $request)
    {
        $request->validated($request->all());

        $Appointment= Appointment::create([
         
            'user_id' => $request->user_id,
            //'doctor_id' => $request->doctor_id,
            'specialization' => $request->specialization,
            'day' => $request->day, 
            'month' => $request->month, 
            'year' => $request->year, 
            'hour' => $request->hour, 
            'minute' => $request->minute,     
        ]);

        return new AppointmentResource($Appointment);
    }

    
    public function show( Request $Appointment,$id)
    {

        try{
            $Appointment=Appointment::find($id);
            if($Appointment!=null){
                return   new AppointmentResource($Appointment);
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

   

   
    public function update($id,AppointmentRequest  $request)
    {

        $Appointment =Appointment ::find($id);
        $Appointment ->update($request->all());
        return new AppointmentResource($Appointment );
    }

    public function destroy($id)
    {
       
        try{
            $Appointment= Appointment::find($id );
            if($Appointment!=null){
                $Appointment->delete();
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

