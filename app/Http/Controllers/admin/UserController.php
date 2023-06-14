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

    $users=User::where('remember_token','=','Y')
    ->orderBy('id','desc')
    ->paginate(2);

    // $users=User::where('remember_token','=','Y')
    // ->orderBy('id','DESC')
    // ->skip(1)
    // ->take(2)->get();

    return view('admin.users',['users'=>$users]);
}
public function editUser(Request $request){
    if($request->id)
    {
        $id=$request->id;
        //fetch user details
        $user=User::where('id','=',$id)->first();
          //first() return object and get() return array , for object we use compact
        return view('admin.edit_user',compact('user'));
    }
    else{
        return redirect()->route('admin.users');
    }
   
}
public function editUserSubmit(Request $request){
      $data=$request->validate([
        'name'=>'required',
        'email'=>'required|email|unique:users,email,'.$request->id.',id'
      ]);
      //edit user id
     $user=User::where('id','=',$request->id)->first();
     $user->name=$request->name;
     $user->email=$request->email;
     $user->update();

     return redirect()->route('admin.edit.user',['id'=>$request->id])
     ->with('msg','Data Updated Successfully...');

}
public function deleteUser(Request $request){
        $user=User::where('id','=',$request->id)->first();
        $user->delete();
        return redirect()->route('admin.users')->with('delete','User Deleted Successfully..');
}


}
