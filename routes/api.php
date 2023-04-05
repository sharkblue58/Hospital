<?php

use App\Http\Controllers\Appointment\AppointmentController;
use App\Http\Controllers\Auth\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPassController;
use App\Http\Controllers\Auth\EmailVerfyController;
use App\Http\Controllers\Auth\ForgetPassController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\User\UserController;



//public
Route::post('admin/Login',[AdminController::class,'adminLogin']);
Route::post('register',[RegisterController::class,'register']);
Route::post('login',[LoginController::class,'login']);
Route::post('password/forget-password',[ForgetPassController::class,'forgetPassword']);
Route::post('password/reset-password',[ResetPassController::class,'passwordReset']);


//Auth
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
    Route::get('appointment', 'index')->middleware(['auth:sanctum', 'ability:admin']);
    Route::post('appointment/store','store')->middleware(['auth:sanctum', 'ability:admin']);
    Route::get('appointment/{id}', 'show')->middleware(['auth:sanctum', 'ability:admin']);
    Route::put('appointment/{id}', 'update')->middleware(['auth:sanctum', 'ability:admin']);
    Route::delete('appointment/{id}', 'destroy')->middleware(['auth:sanctum', 'ability:admin']);
});

//doctor
Route::controller(DoctorController::class)->group(function(){
    Route::get('doctor', 'index')->middleware(['auth:sanctum', 'ability:admin']);
    Route::post('doctor/store','store')->middleware(['auth:sanctum', 'ability:admin']);
    Route::get('doctor/{id}', 'show')->middleware(['auth:sanctum', 'ability:admin']);
    Route::put('doctor/{id}', 'update')->middleware(['auth:sanctum', 'ability:admin']);
    Route::delete('doctor/{id}', 'destroy')->middleware(['auth:sanctum', 'ability:admin']);
});

//user
Route::controller(UserController::class)->group(function(){
    Route::get('user', 'index')->middleware(['auth:sanctum', 'ability:admin']);
    Route::post('user/store','store')->middleware(['auth:sanctum', 'ability:admin']);
    Route::get('user/{id}', 'show')->middleware(['auth:sanctum', 'ability:admin']);
    Route::put('user/{id}', 'update')->middleware(['auth:sanctum', 'ability:admin']);
    Route::delete('user/{id}', 'destroy')->middleware(['auth:sanctum', 'ability:admin']);
});