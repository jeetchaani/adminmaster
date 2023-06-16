<?php

namespace App\Http\Controllers\admin;
use App\Models\Admin;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class LoginController extends Controller
{
     
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        // Perform user registration or login logic here
         
            //check user exist or not 

            $data=User::where('email','=',$user->email)->first();
             if(!$data){
                //insert 
                User::create([
                    'name'=>$user->name,
                    'email'=>$user->email,
                    'password'=>encrypt("123456"),
                    'remember_token'=>'Y'
                  ]);
               return redirect()->route('admin.users')
               ->with('msg','New User Added Successfully..');
             }
             else
             {
                return redirect()->route('admin.users')
                ->with('delete','New User Already Exist..'); 
             }

         //print_r($user);
        //return redirect()->route('home');
    }
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
