<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\api\LoginController;
use App\Http\Controllers\admin\api\UserController;


//set route for admin api

Route::prefix('admin')->group(function () {
         //login api
        Route::post('/login',[LoginController::class,'login']);
        //protected routes
        
        Route::middleware(['auth:sanctum','abilities:admin'])->group(function () {
            //create post route to create user
            Route::post('/user/create', [UserController::class,'addUser']);



        });
});
