<?php

namespace App\Http\Controllers\admin\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Auth;
use Http\Models\Admin;
use Carbon\Carbon;

class LoginController extends Controller
{
    //login api for admin login 
    //send email n password to auth login
    public function login(Request $request){
            $validator=Validator::make($request->all(),[
                'email'=>'required|email',
                'password'=>'required'
            ],[
                'email.required'=>'Email is required',
                'email.email'=>'Please Enter correct email',
                'password.required'=>'Password is required'
            ]);
            //if validation fails
            if($validator->fails()){
                return response()->json([
                    'status'=>false,
                    'message'=>$validator->errors()
                ], 422);
            } else {
                  //check for auth login 
                     if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
                         //get user
                         // Authentication passed
                        $user = Auth::guard('admin')->user();

                        // Generate and return an API token for the user
                        //$expiresAt = Carbon::now()->addHours(2); // Set expiration time to 2 hours

                        $token = $user->createToken('AdminToken', ['admin'])->plainTextToken;
                        // $token->expires_at = $expiresAt;
                        // $token->save();  

                        return response()->json([
                                'status'=>true,
                                'message'=>[
                                    'user' => [
                                        'email' => $user->email,
                                        'id' => $user->id
                                    ],
                                    'token'=>$token
                                ]
                                ], 200);
                     }
                     else{
                        return response()->json([
                            'status'=>false,
                            'message'=>"Invalid Email or Password"
                        ], 401);
                     }
            }

    }
}