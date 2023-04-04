<?php

use App\Http\Controllers\Appointment\AppointmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPassController;
use App\Http\Controllers\Auth\EmailVerfyController;
use App\Http\Controllers\Auth\ForgetPassController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


//public
Route::post('register',[RegisterController::class,'register']);
Route::post('login',[LoginController::class,'login']);
Route::post('admin/login',[AdminController::class,'login']);
Route::post('password/forget-password',[ForgetPassController::class,'forgetPassword']);
Route::post('password/reset-password',[ResetPassController::class,'passwordReset']);
//admin
Route::get('admin/Alladmins',[AdminProfileController::class,'profile'])
->middleware(['auth:sanctum', 'ability:admin']);

//user
Route::post('email-verfication',[EmailVerfyController::class,'emaiVerify'])
->middleware(['auth:sanctum', 'ability:user,admin']);
Route::get('email-verfication',[EmailVerfyController::class,'resendEmailVerify'])
->middleware(['auth:sanctum', 'ability:user,admin']);
Route::post('logout',[LogoutController::class,'logout'])
->middleware(['auth:sanctum', 'ability:user,admin']);

//google
Route::controller(GoogleController::class)->group(function(){
    Route::get('/google/redirect', 'redirect');
    Route::get('/google/callback', 'callback');
});

//facebook
Route::controller(FacebookController::class)->group(function(){
    Route::get('/facebook/redirect', 'redirect');
    Route::get('/facebook/callback', 'callback');
});

//appointment
Route::controller(AppointmentController::class)->group(function(){
    Route::get('appointment', 'index');
    Route::post('appointment/store','store');
    Route::get('appointment/{id}', 'show');
    Route::put('appointment/{id}', 'update');
    Route::delete('appointment/{id}', 'destroy');
});