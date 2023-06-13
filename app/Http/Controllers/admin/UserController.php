<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function addUser(Request $request){
                  //validate user data
            $data=$request->validate([
               'name'=>'required',
               'email'=>'required|email|unique:users,email',
               'password'=>'required'
            ],[
                'name.required'=>'Please Fill Your Name',
                'email.required'=>'Please Fill Email',
                'email.email'=>'Please Write Correct Email',
                'email.unique'=>'Email Already Exist..',
                'password.required'=>'Please Enter Password'
            ]);    
           //create new user 

          $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>encrypt($request->password),
            'remember_token'=>'Y'
          ]);
          //rediret to users

          if($user)
          {
              return redirect()->route('admin.users')->with('msg','User Added Successfully..');
          }

    }
public function users(){
    //show all data 

    $users=User::where('remember_token','=','Y')->get();
    return view('admin.users',['users'=>$users]);
}


}
