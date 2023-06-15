<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\ImageController;

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
        
        Route::get('/user/edit',[UserController::class,'editUser'])->name('edit.user');

        Route::post('/user/edit', [UserController::class,'editUserSubmit'])->name('edit.submit.user');
        
        Route::get('/user/delete',[UserController::class,'deleteUser'])
        ->name('user.delete');

        Route::get('/images',[ImageController::class,'imagesLoad'])->name('images');

        Route::prefix('image')->group(function () {
                Route::get('/add',[ImageController::class,'addImages'])->name('image.add');
                Route::get('/delete',[ImageController::class,'deleteImage'])->name('image.delete');
        });

        Route::post('/add',[ImageController::class,'imageUpload'])->name('submit.image');
        
 
      });
    
      

});
