<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{


    
    // public function login(Request $request){
    //     $loginUserData = $request->validate([
    //         'email'=>'required|string|email',
    //         'password'=>'required|min:8'
    //     ]);
    //     $user = User::where('email',$loginUserData['email'])->first();
    //     if(!$user || !Hash::check($loginUserData['password'],$user->password)){
    //         return response()->json([
    //             'message' => 'Invalid Credentials'
    //         ],401);
    //     }
    //     $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
    //     return response()->json([
    //         'access_token' => $token,
    //     ]);
    // }


    // Login API - POST (email, password)
    public function login(Request $request){

        // Validation
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $token = auth()->attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);

        if(!$token){

            return response()->json([
                "status" => false,
                "message" => "Invalid login details"
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "User logged in succcessfully",
            "token" => $token,
            "token_type" => "bearer",
            "expires_in" => auth()->factory()->getTTL() * 60
        ]);

    }

    public function logout(){
        auth()->user()->tokens()->delete();
    
        return response()->json([
          "message"=>"logged out"
        ]);
    }
}
