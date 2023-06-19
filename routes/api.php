<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\api\LoginController;


//set route for admin api

Route::prefix('admin')->group(function () {
         //login api
        Route::post('/login',[LoginController::class,'login']);
        //protected routes
        
});
