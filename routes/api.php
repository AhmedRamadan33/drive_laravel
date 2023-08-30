<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DriveApiController;
use App\Http\Controllers\API\AuthApiController;


Route::post('register',[AuthApiController::class,'register']);
Route::post('login',[AuthApiController::class,'login']);


Route::middleware("auth:sanctum")->group(function(){
    Route::get('index',[DriveApiController::class,'index']);
    Route::post('store',[DriveApiController::class,'store']);
    Route::post('update/{id}',[DriveApiController::class,'update']);
    Route::delete('destroy/{id}',[DriveApiController::class,'destroy']);
    Route::get('logout',[AuthApiController::class,'logout']);

});


