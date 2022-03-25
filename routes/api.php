<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgetController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\UserController;


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //return $request->user();
//});

//Login routes
Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/forgetpassword', [ForgetController::class, 'forgetPassword']);

Route::post('/resetpassword', [ResetController::class, 'resetPassword']);

Route::get('/user', [UserController::class, 'user'])->middleware('auth:api');
