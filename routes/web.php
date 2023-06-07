<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\LoginController;

Route::get('/', function () {
    return view('welcome');
});



//routes for admin

Route::prefix('admin')->name('admin.')->group(function () {
      //without login
      Route::get('/login', [LoginController::class,'index'])->name('login');
      Route::post('/login/submit', [LoginController::class,'adminLogin'])->name('login.submit');

});
