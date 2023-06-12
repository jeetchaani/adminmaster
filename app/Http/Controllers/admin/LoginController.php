<?php

namespace App\Http\Controllers\admin;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index(){
        return view('admin.login');
    }
    public function adminLogin(Request $request){
        //method 1 when ajax is not used
        //get data from input & check validation
            $input_data=$request->validate([
                'email'=>'required|email',
                'password'=>'required'
            ]);
        //check from database & response
           $credentials=$request->only('email','password');
              if(Auth::guard('admin')->attempt($credentials))
              {
                return redirect()->route('admin.dashboard');   
              }
              else {
                 return redirect()
                 ->route('admin.login')
                 ->with('loginError','Please Enter Correct Email or Password..');
              }
    }
    public function logout(){
             Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
