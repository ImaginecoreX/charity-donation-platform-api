<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\donationController;
use App\Http\Controllers\eventController;
use App\Http\Controllers\requestController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//http://localhost:8000/api

///////////////////////////////////user///////////////////////////////////////

//user registration 
//http://localhost:8000/api/reg-user
Route::post('/reg-user',[UserController::class, 'registerUser']);

//login user
//http://localhost:8000/api/login-user
Route::post('/login-user',[UserController::class,'loginUser']);

//http://localhost:8000/api/update-user
Route::put('/update-user',[UserController::class,'updateUser']);

//http://localhost:8000/api/all-user
Route::put('/all-user',[UserController::class,'allUser']);

//http://localhost:8000/api/blockUser/{email}/{status}
Route::get('/blockUser/{email}/{status}',[UserController::class,'blockUser']);

//http://localhost:8000/api/update-user
Route::get('/get-block-users',[UserController::class,'getBlockUsers']);

//http://localhost:8000/api/all-user
Route::get('/get-unblock-users',[UserController::class,'getUnblockUsers']);

///////////////////////////////////event///////////////////////////////////////


//http://localhost:8000/api/add-event
Route::post('/add-event',[eventController::class, 'addEvent']);


//http://localhost:8000/api/update-event/{id}
Route::put('/update-event/{id}',[eventController::class,'updateEvent']);

//http://localhost:8000/api/update-user
Route::get('/get-all-event',[eventController::class,'allEvent']);

//http://localhost:8000/api/all-user/{id}
Route::get('/get-event/{id}',[eventController::class,'eventSearch']);

///////////////////////////////////Request///////////////////////////////////////


//http://localhost:8000/api/add-event
Route::post('/send-request',[requestController::class, 'sendRequest']);

//http://localhost:8000/api/update-event/{id}/{current_status_id}
Route::get('/request-status-update/{id}/{current_status_id}',[requestController::class,'requestStatusUpdate']);

//http://localhost:8000/api/update-request
Route::put('/update-request/{reqId}',[requestController::class,'updateRequest']);

//http://localhost:8000/api/all-request
Route::get('/all-request',[requestController::class,'allRequest']);

///////////////////////////////////Donation///////////////////////////////////////


//http://localhost:8000/api/donate
Route::post('/donate',[donationController::class, 'donate']);

//http://localhost:8000/api/all-donations
Route::get('/all-donations',[donationController::class,'allDonation']);


///////////////////////////////////admin///////////////////////////////////////
//http://localhost:8000/api/add-admin
Route::post('/add-admin',[adminController::class, 'addAdmin']);

//http://localhost:8000/api/add-admin
Route::post('/add-code',[adminController::class, 'addCode']);


//http://localhost:8000/api/admin-login
Route::post('/admin-login',[adminController::class, 'admin-login']);