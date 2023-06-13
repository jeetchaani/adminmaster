<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\UserController;

Route::get('/', function () {
    return view('welcome');
});



//routes for admin

Route::prefix('admin')->name('admin.')->group(function () {
      //without login
      Route::get('/login', [LoginController::class,'index'])->name('login');
      Route::post('/login/submit', [LoginController::class,'adminLogin'])->name('login.submit');
      Route::get('/logout',[LoginController::class,'logout'])->name('logout');

      Route::middleware(['admin'])->group(function () {
        
        Route::get('/dashboard', function(){
            return view('admin.dashboard');
         })->name('dashboard');
       
        Route::get('/users',[UserController::class,'users'])->name('users');

        Route::get('/user/add',function(){
                    return view('admin.add_user');
        })->name('add.user');
            //add new user

        Route::post('/user/add', [UserController::class,'addUser'])->name('submit.user');    


      });
    
      

});
