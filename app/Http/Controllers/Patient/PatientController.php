<?php

namespace App\Http\Controllers\Patient;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    public function index()
    {
        
        try {
            $allPatient = User::all()->where('role','user');
            if ($allPatient != null) {
                return response()->json([
                    'status' => 'true',
                    'data' => $allPatient,
                ], 201);
            } else {
                return response()->json([
                    'status' => 'true',
                    'msg' => 'there is no Patient now '
                ],201);
            }
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'expcetion' => $ex->getMessage(), 'msg' => 'failed to get patient'], 500);
        }

    }

    public function store(Request $request)
    {
        $patient = new User();
        $patient->user_id = $request->user_id;
        $patient->payment_type = $request->payment_type;
        $patient->provider = $request->provider;
        $patient->account_no = $request->account_no;
        $patient->expiry = $request->expiry;
        $patient->save();
        return response()->json([
            'status' => 'true',
            'msg' => 'data stored successfuly'
        ], 201);
    }

    public function show($id)
    {
        try {
            $patient = User::find($id)->where('role','user');
            if ($patient != null) {
                return response()->json([
                    'status' => 'true',
                    'user' => $patient,
                ], 201);
            } else {
                return response()->json([
                    'status' => 'true',
                    'msg' => 'no records with this id ,please check id ! '
                ],201);
            }
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'expcetion' => $ex->getMessage(), 'msg' => 'view process failed'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $patient = User::find($id)->where('role','user');
            if ($patient != null) {
                $patient->rate = $request->rate;
                $patient->desc = $request->desc;
                $patient->save();
                return response()->json([
                    'status' => 'true',
                    'msg' => 'your patient is updated now'
                ],201);
            } else {
                return response()->json([
                    'status' => 'true',
                    'msg' => 'no records with this id ,please check id ! '
                ],201);
            }
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'expcetion' => $ex->getMessage(), 'msg' => 'update process failed'], 500);
        }
    }

    public function destroy($id)
    {
        try {

            $patient = User::find($id)->where('role','user');
            if ($patient != null) {
                $patient->delete();
                return response()->json([
                    'status' => 'true',
                    'msg' => 'your patient is deleted now'
                ],201);
            } else {
                return response()->json([
                    'status' => 'true',
                    'msg' => 'no records with this id ,please check id ! '
                ],201);
            }
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'expcetion' => $ex->getMessage(), 'msg' => 'delete process failed'], 500);
        }
    }
}
